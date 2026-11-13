/**
 * Khởi tạo biểu đồ Dashboard với Chart.js
 */
document.addEventListener('DOMContentLoaded', () => {
    const flowEl = document.getElementById('monthlyFlowChart');
    if (flowEl && window.dashboardChartData) {
        const { chartLabels, chartReceipts, chartIssues } = window.dashboardChartData;
        const ctxFlow = flowEl.getContext('2d');
        new Chart(ctxFlow, {
            type: 'bar',
            data: {
                labels: chartLabels || [],
                datasets: [
                    {
                        label: 'Giá trị nhập kho (VNĐ)',
                        data: chartReceipts || [],
                        backgroundColor: 'rgba(37, 99, 235, 0.75)',
                        borderColor: '#2563eb',
                        borderWidth: 1,
                        borderRadius: 6,
                    },
                    {
                        label: 'Giá trị xuất kho (VNĐ)',
                        data: chartIssues || [],
                        backgroundColor: 'rgba(16, 185, 129, 0.75)',
                        borderColor: '#10b981',
                        borderWidth: 1,
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + new Intl.NumberFormat('vi-VN').format(context.raw) + ' đ';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(val) {
                                return (val / 1000000).toFixed(0) + ' Tr';
                            }
                        }
                    }
                }
            }
        });
    }

    const catEl = document.getElementById('categoryChart');
    if (catEl && window.dashboardCatData) {
        const { catLabels, catData } = window.dashboardCatData;
        const ctxCat = catEl.getContext('2d');
        new Chart(ctxCat, {
            type: 'doughnut',
            data: {
                labels: catLabels || [],
                datasets: [{
                    data: catData || [],
                    backgroundColor: [
                        '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#06b6d4'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }
});
