{{--
    Chart helper bersama (Chart.js) — dipakai modul absensi, evaluasi jasmani,
    data fisik, dan pantauan orang tua.
    Warna seri: Akademik = biru, Jasmani = oranye (aman untuk buta warna),
    seri tunggal = hijau brand. Mode gelap memakai langkah warna tersendiri.
--}}
@once
<script src="{{ asset('vendor/chartjs/chart.umd.min.js') }}"></script>
<script>
(function () {
    const isDark = () => document.documentElement.classList.contains('dark');

    const theme = () => isDark() ? {
        akademik: '#4a8ae6', jasmani: '#d96a26', primary: '#67a067', male: '#4a8ae6', female: '#d96a26',
        muted: '#94989D', grid: 'rgba(255,255,255,0.08)', text: '#C7CBD0', surface: '#0f1a0f',
        tooltipBg: '#F1F2F4', tooltipText: '#252628',
    } : {
        akademik: '#2a6fdb', jasmani: '#c2570f', primary: '#418741', male: '#2a6fdb', female: '#c2570f',
        muted: '#94989D', grid: 'rgba(0,0,0,0.06)', text: '#6F7276', surface: '#ffffff',
        tooltipBg: '#252628', tooltipText: '#F8F9FA',
    };

    const registry = [];

    function baseOptions(cfg) {
        const t = theme();
        const suffix = cfg.ySuffix ?? '';
        return {
            responsive: true,
            maintainAspectRatio: false,
            animation: { duration: 400 },
            interaction: { mode: cfg.type === 'line' ? 'index' : 'nearest', intersect: cfg.type !== 'line' },
            layout: { padding: { top: 6, right: 8 } },
            plugins: {
                legend: {
                    display: cfg.legend ?? (cfg.datasets.length > 1),
                    position: 'top',
                    align: 'end',
                    labels: { color: t.text, usePointStyle: true, pointStyle: 'circle', boxWidth: 8, boxHeight: 8, padding: 14, font: { size: 12 } },
                },
                tooltip: {
                    backgroundColor: t.tooltipBg,
                    titleColor: t.tooltipText,
                    bodyColor: t.tooltipText,
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: cfg.datasets.length > 1,
                    usePointStyle: true,
                    callbacks: {
                        title: (items) => {
                            if (!items.length) return '';
                            const i = items[0].dataIndex;
                            return (cfg.tooltipTitles && cfg.tooltipTitles[i]) || items[0].label;
                        },
                        label: (ctx) => {
                            const v = ctx.parsed.y ?? ctx.parsed.x;
                            if (v === null || v === undefined) return null;
                            const name = cfg.datasets.length > 1 ? ctx.dataset.label + ': ' : '';
                            const extra = cfg.tooltipExtra ? cfg.tooltipExtra(ctx) : '';
                            return name + Number(v).toLocaleString('id-ID', { maximumFractionDigits: 2 }) + suffix + (extra ? ' ' + extra : '');
                        },
                    },
                },
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { color: t.grid },
                    ticks: { color: t.text, maxRotation: 0, autoSkip: true, autoSkipPadding: 12, font: { size: 11 } },
                },
                y: {
                    min: cfg.yMin, max: cfg.yMax,
                    suggestedMin: cfg.ySuggestedMin, suggestedMax: cfg.ySuggestedMax,
                    beginAtZero: cfg.beginAtZero ?? (cfg.type === 'bar'),
                    reverse: !!cfg.yReverse,
                    grid: { color: t.grid },
                    border: { display: false },
                    ticks: {
                        color: t.text, font: { size: 11 }, maxTicksLimit: 6,
                        callback: (v) => Number(v).toLocaleString('id-ID') + suffix,
                    },
                },
            },
        };
    }

    function build(canvas, cfg) {
        const t = theme();
        const datasets = cfg.datasets.map((d) => {
            const color = t[d.color] || d.color || t.primary;
            if (cfg.type === 'bar') {
                return {
                    label: d.label, data: d.data,
                    backgroundColor: d.colors ? d.colors.map(c => t[c] || c) : color,
                    borderRadius: 4, borderSkipped: 'start', maxBarThickness: 28,
                    categoryPercentage: 0.8, barPercentage: 0.9,
                };
            }
            return {
                label: d.label, data: d.data,
                borderColor: color, backgroundColor: color,
                borderWidth: 2, tension: 0.25, spanGaps: true,
                pointRadius: 4, pointHoverRadius: 6,
                pointBorderColor: t.surface, pointBorderWidth: 2,
                borderDash: d.dashed ? [5, 4] : undefined,
            };
        });

        const options = baseOptions(cfg);
        if (cfg.sparkline) {
            options.scales.x.display = false;
            options.scales.y.display = false;
            options.layout.padding = { top: 6, right: 6, bottom: 2, left: 6 };
        }
        if (cfg.horizontal) {
            options.indexAxis = 'y';
            const x = options.scales.x, y = options.scales.y;
            options.scales = { x: { ...y, beginAtZero: true }, y: { ...x, ticks: { ...x.ticks, autoSkip: false } } };
        }

        return new Chart(canvas, { type: cfg.type, data: { labels: cfg.labels, datasets }, options });
    }

    window.SNChart = {
        theme,
        render(id, cfg) {
            const canvas = typeof id === 'string' ? document.getElementById(id) : id;
            if (!canvas || typeof Chart === 'undefined') return null;
            const entry = { canvas, cfg, chart: build(canvas, cfg) };
            registry.push(entry);
            return entry.chart;
        },
    };

    // Re-render saat tema terang/gelap berubah
    new MutationObserver(() => {
        registry.forEach((e) => { e.chart.destroy(); e.chart = build(e.canvas, e.cfg); });
    }).observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
})();
</script>
@endonce
