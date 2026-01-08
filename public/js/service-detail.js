// Service database
const services = {
    'pc': {
        id: 'pc',
        title: "Game PC & Console Development",
        category: "pc",
        image: "../assets/img/masonry-portfolio/pc1.jpg",
        description: "Kami menyediakan layanan pengembangan game untuk platform PC dan konsol dengan kualitas tinggi dan performa optimal.",
        features: [
            "Pengembangan game untuk Windows, macOS, Linux",
            "Porting ke platform konsol (PlayStation, Xbox, Nintendo)",
            "Optimasi performa untuk berbagai spesifikasi hardware",
            "Integrasi platform distribusi digital (Steam, Epic Games, dll)",
            "Dukungan multiplayer dan online features"
        ],
        downloads: [
            { type: "pdf", url: "#", label: "PC Game Catalog" },
            { type: "doc", url: "#", label: "Technical Specifications" }
        ],
        additionalContent: `
    <h4>Proses Pengembangan</h4>
    <p>Kami menggunakan pipeline pengembangan modern dengan teknologi terkini untuk memastikan kualitas terbaik:</p>
    <ol>
      <li>Konsep dan desain game</li>
      <li>Prototyping dan proof-of-concept</li>
      <li>Pengembangan inti game</li>
      <li>Testing dan quality assurance</li>
      <li>Optimasi dan polishing</li>
      <li>Publishing dan distribusi</li>
    </ol>
  `
    },
    'hp': {
        id: 'hp',
        title: "Mobile Game Development",
        category: "hp",
        image: "../assets/img/masonry-portfolio/mobile1.jpg",
        description: "Layanan pengembangan game mobile untuk platform iOS dan Android dengan fokus pada pengalaman pengguna yang optimal.",
        features: [
            "Pengembangan untuk iOS dan Android",
            "Optimasi untuk berbagai ukuran layar",
            "Integrasi dengan platform mobile (Google Play, App Store)",
            "Monetisasi (IAP, Ads, Subscriptions)",
            "Dukungan touch controls dan mobile-specific features"
        ],
        downloads: [
            { type: "pdf", url: "#", label: "Mobile Game Portfolio" },
            { type: "doc", url: "#", label: "Mobile Development Guide" }
        ],
        additionalContent: `
    <h4>Keunggulan Layanan Kami</h4>
    <p>Kami memiliki pengalaman luas dalam mengembangkan game mobile yang sukses di pasar:</p>
    <ul>
      <li>Fokus pada performa dan penghematan baterai</li>
      <li>Desain UI/UX khusus mobile</li>
      <li>Integrasi analytics untuk tracking performa</li>
    </ul>
  `
    },
    'art': {
        id: 'art',
        title: "Seni & Animasi Game",
        category: "art",
        image: "../assets/img/masonry-portfolio/aset4.jpg",
        description: "Visual memukau dengan desain karakter, lingkungan, dan animasi berkualitas tinggi.",
        features: [
            "Desain karakter 2D/3D",
            "Pembuatan environment dan props",
            "User Interface design",
            "Animasi karakter dan cutscene",
            "Konsep art dan visual development"
        ],
        downloads: [
            { type: "pdf", url: "#", label: "Art Portfolio" },
            { type: "pdf", url: "#", label: "Art Style Guide" }
        ],
        additionalContent: `
    <h4>Style yang Kami Tawarkan</h4>
    <p>Kami dapat menyesuaikan dengan berbagai gaya seni:</p>
    <div class="row">
      <div class="col-md-6">
        <h5>2D Art Styles</h5>
        <ul>
          <li>Pixel Art</li>
          <li>Vector Art</li>
          <li>Hand-drawn</li>
        </ul>
      </div>
      <div class="col-md-6">
        <h5>3D Art Styles</h5>
        <ul>
          <li>Low Poly</li>
          <li>Stylized</li>
          <li>Realistic</li>
        </ul>
      </div>
    </div>
  `
    },
    'custom': {
        id: 'custom',
        title: "Costume Game Development",
        category: "custom",
        image: "../assets/img/masonry-portfolio/serp1.png",
        description: "Kami menciptakan game unik dan berkualitas tinggi sesuai dengan visi dan kebutuhan klien.",
        features: [
            "Pengembangan game sesuai spesifikasi klien",
            "Solusi game untuk kebutuhan khusus",
            "Pembuatan konsep original",
            "Development end-to-end",
            "Dukungan pasca-launch"
        ],
        downloads: [
            { type: "pdf", url: "#", label: "Custom Game Portfolio" },
            { type: "doc", url: "#", label: "Custom Development Process" }
        ],
        additionalContent: `
    <h4>Proses Custom Development</h4>
    <p>Kami bekerja sama dengan klien melalui tahapan:</p>
    <ol>
      <li>Konsultasi kebutuhan</li>
      <li>Pembuatan konsep dan design document</li>
      <li>Development iteratif dengan feedback</li>
      <li>Testing dan polishing</li>
      <li>Peluncuran dan dukungan</li>
    </ol>
  `
    },
    'platform': {
        id: 'platform',
        title: "Integrasi Lintas Platform",
        category: "platform",
        image: "../assets/img/masonry-portfolio/serp2.png",
        description: "Kami mengembangkan game yang dapat dimainkan di berbagai platform dengan pengalaman konsisten.",
        features: [
            "Single codebase untuk multi-platform",
            "Adaptasi kontrol untuk setiap platform",
            "Optimasi performa spesifik platform",
            "Cloud save dan cross-play",
            "Integrasi platform-specific features"
        ],
        downloads: [
            { type: "pdf", url: "#", label: "Cross-Platform Case Studies" },
            { type: "doc", url: "#", label: "Platform Integration Guide" }
        ],
        additionalContent: `
    <h4>Platform yang Didukung</h4>
    <p>Kami memiliki pengalaman dengan berbagai platform:</p>
    <ul>
      <li>PC (Windows, Mac, Linux)</li>
      <li>Mobile (iOS, Android)</li>
      <li>Console (PlayStation, Xbox, Switch)</li>
      <li>Web (HTML5, WebGL)</li>
    </ul>
  `
    }
};

// Get service ID from URL
const urlParams = new URLSearchParams(window.location.search);
const serviceId = urlParams.get('service_id');

// Display service details
document.addEventListener('DOMContentLoaded', function () {
    // Set active service (default to pc if none specified)
    const activeService = serviceId && services[serviceId] ? services[serviceId] : services['pc'];

    // Update page title
    document.title = `${activeService.title} | CuyNest`;

    // Set service details
    document.getElementById('service-main-title').textContent = activeService.title;
    document.getElementById('service-subtitle').textContent = activeService.description;
    document.getElementById('current-service').textContent = activeService.title;
    document.getElementById('service-category-link').textContent = activeService.category.toUpperCase();
    document.getElementById('service-category-link').href = `${activeService.category}.html`;

    // Set main content
    document.getElementById('service-title').textContent = activeService.title;
    document.getElementById('service-description').textContent = activeService.description;
    document.getElementById('service-main-image').src = activeService.image;
    document.getElementById('service-main-image').alt = activeService.title;
    document.getElementById('service-additional-content').innerHTML = activeService.additionalContent;

    // Create features list
    const featuresList = document.getElementById('service-features-list');
    featuresList.innerHTML = '';
    activeService.features.forEach(feature => {
        const li = document.createElement('li');
        li.innerHTML = `<i class="bi bi-check-circle"></i> <span>${feature}</span>`;
        featuresList.appendChild(li);
    });

    // Create services list
    const servicesList = document.getElementById('services-list');
    servicesList.innerHTML = '';
    Object.values(services).forEach(service => {
        const a = document.createElement('a');
        a.href = `service?service_id=${service.id}`;
        a.className = service.id === activeService.id ? 'active' : '';
        a.innerHTML = `<i class="bi bi-arrow-right-circle"></i><span>${service.title}</span>`;
        servicesList.appendChild(a);
    });

    // Create download links
    const downloadLinks = document.getElementById('download-links');
    downloadLinks.innerHTML = '';
    activeService.downloads.forEach(download => {
        const a = document.createElement('a');
        a.href = download.url;
        const iconClass = download.type === 'pdf' ? 'bi-filetype-pdf' : 'bi-file-earmark-word';
        a.innerHTML = `<i class="bi ${iconClass}"></i><span>${download.label}</span>`;
        downloadLinks.appendChild(a);
    });

    // Initialize AOS
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });
});
