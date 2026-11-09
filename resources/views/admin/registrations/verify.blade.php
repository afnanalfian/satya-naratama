@include('admin.registrations.show', ['registration' => $registration->load('invoice', 'verifiedBy')])
