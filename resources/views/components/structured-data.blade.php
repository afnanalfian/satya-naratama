@if(request()->routeIs('home') || request()->routeIs('landing'))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "Satya Naratama",
  "description": "Bimbel Kedinasan TNI POLRI, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.",
  "url": "https://satyanaratama.id",
  "logo": "https://satyanaratama.id/img/logo.png",
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "ID"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+62-851-4133-9645",
    "contactType": "Customer Service",
    "availableLanguage": "Indonesian"
  },
  "sameAs": [
    "https://www.instagram.com/satya.naratama",
    "https://www.tiktok.com/@satya.naratama",
    "https://www.youtube.com/@SatyaNaratama"
  ],
  "offers": {
    "@type": "Offer",
    "category": "Educational Courses",
    "availability": "https://schema.org/InStock"
  }
}
</script>
@endif
