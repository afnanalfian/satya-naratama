<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/**
 * Membuka setiap halaman GET (tanpa parameter + beberapa contoh berparameter)
 * untuk tiap peran dan memastikan tidak ada error 500.
 * Membutuhkan database berisi DemoDataSeeder.
 */
class SmokeTest extends TestCase
{
    protected function paramUrls(): array
    {
        $m = \App\Models\Meeting::first();
        $c = \App\Models\Course::first();
        $s = User::role('siswa')->first();
        $e = \App\Models\Exam::first();
        $ev = \App\Models\PhysicalEvaluation::first();
        $t = \App\Models\Teacher::first();
        $urls = [];
        if ($c) { $urls[] = "/course/{$c->slug}"; $urls[] = "/course/{$c->slug}/edit"; $urls[] = "/course/{$c->id}/meetings/create"; $urls[] = "/purchase/browse/course/{$c->id}"; }
        if ($m) { $urls[] = "/meetings/{$m->slug}"; $urls[] = "/meetings/{$m->slug}/edit"; $urls[] = "/meetings/{$m->slug}/attendance"; $urls[] = "/meetings/{$m->slug}/video/create"; }
        if ($s) { $urls[] = "/siswa/{$s->id}"; $urls[] = "/absensi/siswa/{$s->id}"; $urls[] = "/monitoring/siswa/{$s->id}"; $urls[] = "/monitoring/data-fisik/siswa/{$s->id}"; $urls[] = "/admin/students/{$s->id}/edit"; $urls[] = "/pantau/".$s->ensureTokens()->parent_token; }
        if ($ev) { foreach (['', '/edit', '/input'] as $x) $urls[] = "/evaluasi-jasmani/{$ev->id}{$x}"; }
        if ($t) { $urls[] = "/tentor/{$t->id}"; $urls[] = "/tentor/{$t->id}/edit"; }
        if ($e) { foreach (['', '/edit', '/results', '/attempt', '/result', '/ranking'] as $x) $urls[] = "/exams/{$e->exam_code}{$x}"; }
        foreach (\App\Models\Order::limit(2)->get() as $o) { $urls[] = "/orders/{$o->order_code}"; $urls[] = "/my/orders/{$o->order_code}"; $urls[] = "/checkout/{$o->order_code}/payment"; $urls[] = "/checkout/{$o->order_code}/waiting"; $urls[] = "/orders/{$o->order_code}/invoice"; }
        foreach (\App\Models\QuestionCategory::limit(1)->get() as $qc) { $urls[] = "/bank-soal/categories/{$qc->slug}/materials"; $urls[] = "/bank-soal/categories/{$qc->slug}/edit"; $urls[] = "/bank-soal/categories/{$qc->slug}/materials/create"; }
        foreach (\App\Models\QuestionMaterial::limit(1)->get() as $qm) { $urls[] = "/bank-soal/materials/{$qm->id}/questions"; $urls[] = "/bank-soal/materials/{$qm->id}/questions/create"; $urls[] = "/bank-soal/materials/{$qm->id}/edit"; }
        foreach (\App\Models\Question::limit(1)->get() as $q) { $urls[] = "/bank-soal/questions/{$q->id}/edit"; }
        foreach (\App\Models\Product::limit(1)->get() as $p) { $urls[] = "/admin/products/{$p->id}/edit"; $urls[] = "/bonuses/{$p->id}/edit"; }
        foreach (\App\Models\PricingRule::limit(1)->get() as $p) { $urls[] = "/pricing/{$p->id}/edit"; }
        foreach (\App\Models\Discount::limit(1)->get() as $p) { $urls[] = "/discounts/{$p->id}"; $urls[] = "/discounts/{$p->id}/edit"; }
        foreach (\App\Models\PromoBanner::limit(1)->get() as $p) { $urls[] = "/promo-banners/{$p->id}/edit"; }
        foreach (\App\Models\StudentRegistration::limit(1)->get() as $r) { $urls[] = "/admin/registrations/{$r->id}"; $urls[] = "/admin/registrations/{$r->id}/verify"; $urls[] = "/admin/registrations/{$r->id}/reject"; $urls[] = "/daftar/success/{$r->id}"; }

        return $urls;
    }

    public function test_pages_render_for_each_role(): void
    {
        if (! \App\Models\User::where('email', 'admin@demo.test')->exists()) {
            $this->markTestSkipped('Butuh database lokal berisi DemoDataSeeder.');
        }
        $static = collect(Route::getRoutes())->filter(fn ($r) => in_array('GET', $r->methods()) && ! str_contains($r->uri(), '{'))
            ->map(fn ($r) => '/'.ltrim($r->uri(), '/'))
            ->reject(fn ($u) => preg_match('#^/(livewire|_ignition|sanctum|up|api|storage|logout|keep-alive|ajax)#', $u))
            ->values()->all();
        $urls = array_merge($static, $this->paramUrls());
        $failures = [];

        foreach (['guest', 'admin@demo.test', 'tentor@demo.test', 'siswa@demo.test'] as $who) {
            foreach ($urls as $url) {
                $this->refreshApplication();
                $req = $who === 'guest' ? $this : $this->actingAs(User::where('email', $who)->firstOrFail());
                $res = $req->get($url);
                if ($res->getStatusCode() >= 500) {
                    $msg = $res->exception ? get_class($res->exception).': '.$res->exception->getMessage().' @ '.str_replace(base_path(), '', $res->exception->getFile()).':'.$res->exception->getLine() : substr(strip_tags($res->getContent()), 0, 300);
                    $failures[] = "[$who] $url → {$res->getStatusCode()} ".$msg;
                }
            }
        }

        $this->assertEmpty($failures, implode("\n", $failures));
    }
}
