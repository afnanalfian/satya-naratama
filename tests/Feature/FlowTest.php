<?php

namespace Tests\Feature;

use App\Livewire;
use App\Models\Exam;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserEntitlement;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire as LW;
use Tests\TestCase;

/** Alur utama: beli paket → bayar → admin setujui → akses terbuka; mengerjakan tryout. Memakai DemoDataSeeder, dibungkus transaksi. */
class FlowTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (! \App\Models\User::where('email', 'admin@demo.test')->exists()) {
            $this->markTestSkipped('Butuh database lokal berisi DemoDataSeeder.');
        }
        DB::beginTransaction();
        Storage::fake('public');
    }

    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }

    public function test_purchase_flow_grants_entitlement(): void
    {
        $siswa = User::where('email', 'siswa3@demo.test')->firstOrFail();
        $admin = User::where('email', 'admin@demo.test')->firstOrFail();
        $pkg = Product::where('type', 'course_package')->firstOrFail();
        $tryout = Product::where('type', 'tryout')->firstOrFail();
        $meeting = Product::where('type', 'meeting')->whereHas('productables', fn ($q) => $q->whereIn('productable_id', \App\Models\Meeting::where('course_id', '!=', $pkg->productable->productable_id)->pluck('id')))->first();

        $this->actingAs($siswa);
        LW::test(Livewire\Shop\Browse::class)->call('addToCart', $pkg->id)->assertDispatched('cart-updated');
        LW::test(Livewire\Shop\Browse::class)->call('addToCart', $tryout->id);
        if ($meeting) {
            LW::test(Livewire\Shop\BrowseCourse::class, ['course' => $meeting->productable->productable->course])->call('addToCart', $meeting->id);
        }
        $cart = $siswa->fresh()->cart;
        $this->assertGreaterThanOrEqual(2, $cart->items()->count());
        $this->get('/cart')->assertOk()->assertSee($pkg->name);

        LW::test(Livewire\Shop\Checkout::class)->set('voucher', 'ALUMNI50')->call('applyVoucher')->assertSet('voucherApplied', true)->call('process')->assertRedirect();
        $order = Order::where('user_id', $siswa->id)->latest('id')->firstOrFail();
        $this->assertSame('pending', $order->status);
        $this->assertTrue($order->discounts()->exists());

        LW::test(Livewire\Shop\Payment::class, ['order' => $order])->set('proof', UploadedFile::fake()->image('bukti.jpg'))->call('submitProof')->assertRedirect(route('checkout.waiting', $order));
        $this->assertSame('paid', $order->fresh()->status);

        $this->actingAs($admin);
        LW::test(Livewire\Admin\Orders::class)->call('approve', $order->id);
        $this->assertSame('verified', $order->fresh()->status);
        $this->assertTrue(UserEntitlement::where('user_id', $siswa->id)->where('entitlement_type', 'course')->exists());
        $this->get(route('orders.invoice', $order))->assertOk();
    }

    public function test_exam_attempt_flow(): void
    {
        $siswa = User::where('email', 'siswa5@demo.test')->firstOrFail();
        $exam = Exam::where('type', 'tryout')->firstOrFail();
        $this->actingAs($siswa);

        $this->get(route('exams.show', $exam))->assertOk()->assertSee('Mulai ujian');
        $this->post(route('exams.start', $exam))->assertRedirect(route('exams.attempt', $exam));
        $this->get(route('exams.attempt', $exam))->assertOk()->assertDontSee('is_correct');

        foreach ($exam->questions()->with('question.options')->get() as $eq) {
            $opt = $eq->question->options->sortBy('order')->first();
            $this->postJson(route('exams.answer.save', $exam), ['question_id' => $eq->question_id, 'selected_options' => [$opt->id]])->assertNoContent();
        }
        $this->getJson(route('exams.time.sync', $exam))->assertOk()->assertJsonStructure(['remaining_seconds']);
        $this->post(route('exams.submit', $exam))->assertRedirect(route('exams.result.student', $exam));
        $attempt = $exam->attempts()->where('user_id', $siswa->id)->first();
        $this->assertTrue((bool) $attempt->is_submitted);
        $this->assertGreaterThan(0, $attempt->score);
        $this->get(route('exams.result.student', $exam))->assertOk()->assertSee('Pembahasan');
        $this->get(route('exams.ranking.student', $exam))->assertOk();
    }

    public function test_login_always_remembers_and_keep_alive(): void
    {
        LW::test(Livewire\Auth\Login::class)->set('email', 'siswa@demo.test')->set('password', 'password')->call('login')->assertRedirect();
        $this->assertAuthenticated();
        $this->assertNotNull(User::where('email', 'siswa@demo.test')->value('remember_token'));
        $this->getJson('/keep-alive')->assertOk()->assertJsonStructure(['token']);
        $this->assertGreaterThanOrEqual(525600, config('session.lifetime'));
    }

    public function test_attendance_scan_and_registration(): void
    {
        $tentor = User::where('email', 'tentor@demo.test')->firstOrFail();
        $siswa = User::where('email', 'siswa@demo.test')->firstOrFail()->ensureTokens();
        $m = \App\Models\Meeting::where('status', 'live')->firstOrFail();
        $this->actingAs($tentor)->postJson(route('meeting.attendance.scan', $m), ['code' => $siswa->qr_payload])->assertOk()->assertJson(['ok' => true]);

        auth()->logout();
        $kec = \App\Models\Kecamatan::where('regency_id', 7309)->first();
        LW::test(Livewire\Daftar\Form::class)
            ->set('full_name', 'Calon Siswa')->set('birth_date', '2008-01-01')->set('gender', 'L')->set('school_origin', 'SMAN 1')->set('class', 'XII')->set('phone', '081234')
            ->call('next')->assertSet('step', 2)
            ->set('kecamatan_id', $kec->id)->set('kelurahan_id', $kec->kelurahans()->first()->id)->call('next')->assertSet('step', 3)
            ->set('priority_university_1', 'AKPOL')->set('parent_name', 'Bapak')->set('parent_phone', '0812')->call('next')->assertSet('step', 4)
            ->set('email', 'calon@demo.test')->set('password', 'rahasia123')->set('password_confirmation', 'rahasia123')->set('agree', true)
            ->call('submit')->assertRedirect();
        $reg = \App\Models\StudentRegistration::where('email', 'calon@demo.test')->firstOrFail();
        LW::test(Livewire\Daftar\Payment::class, ['registrationId' => $reg->id])->set('payment_proof', UploadedFile::fake()->image('tf.jpg'))->call('submitProof')->assertRedirect();
        $this->assertSame('awaiting_verification', $reg->fresh()->registration_status);

        $admin = User::where('email', 'admin@demo.test')->first();
        \Illuminate\Support\Facades\Mail::fake();
        $this->actingAs($admin)->post(route('admin.registrations.verify', $reg->id), ['verification_notes' => 'ok'])->assertRedirect();
        $this->assertTrue(User::where('email', 'calon@demo.test')->first()->hasRole('siswa'));
    }

    public function test_question_store_and_exam_builder(): void
    {
        $admin = User::where('email', 'admin@demo.test')->firstOrFail();
        $mat = \App\Models\QuestionMaterial::firstOrFail();
        $this->actingAs($admin)->post(route('bank.material.questions.store', $mat), [
            'test_type' => 'tiu', 'type' => 'mcq', 'question_text' => 'Hasil \\(2+2\\)?', 'correct' => 1,
            'options' => [['text' => '3'], ['text' => '4'], ['text' => '5']],
        ])->assertRedirect();
        $q = \App\Models\Question::latest('id')->first();
        $this->assertSame('4', $q->options()->where('is_correct', true)->value('option_text'));

        $this->post(route('bank.material.questions.store', $mat), [
            'test_type' => 'tkp', 'type' => 'mcq', 'question_text' => 'Sikap?',
            'options' => [['text' => 'a', 'weight' => 5], ['text' => 'b', 'weight' => 1]],
        ])->assertRedirect();
        $this->assertSame(5, (int) \App\Models\Question::latest('id')->first()->options()->max('weight'));

        $exam = Exam::create(['type' => 'quiz', 'test_type' => 'general', 'title' => 'Uji', 'exam_date' => now(), 'status' => 'inactive', 'created_by' => $admin->id]);
        LW::test(Livewire\Exams\Builder::class, ['exam' => $exam])
            ->set('duration_minutes', 10)->call('saveInfo')
            ->call('selectCategory', $mat->category_id)->call('selectMaterial', $mat->id)
            ->call('pickAll')->call('attach');
        $this->assertGreaterThan(0, $exam->questions()->count());
        $this->get(route('exams.edit', $exam))->assertOk();
    }
}
