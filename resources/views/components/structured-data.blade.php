@if(request()->routeIs('home') || request()->routeIs('landing'))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "Azwara Learning",
  "description": "Bimbel online, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.",
  "url": "https://azwaralearning.com",
  "logo": "https://azwaralearning.com/img/logo.png",
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
    "https://www.instagram.com/azwara_learning",
    "https://www.tiktok.com/@azwara.learning",
    "https://www.youtube.com/@AzwaraLearning"
  ],
  "offers": {
    "@type": "Offer",
    "category": "Educational Courses",
    "availability": "https://schema.org/InStock"
  }
}
</script>
@endif
