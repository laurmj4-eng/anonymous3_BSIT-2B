<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper bg-light-modern">
  
  <div class="content-header pb-4 pt-4">
    <div class="container-fluid">
      <div class="welcome-banner animate-fade-up">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h1 class="font-weight-bold text-white mb-1" style="letter-spacing: -0.5px; font-size: 2.2rem;">Dashboard Overview</h1>
            <p class="text-white-50 mb-0" style="font-size: 1.1rem;">Welcome back! Here's a summary of your system's activity today.</p>
          </div>
          <div class="col-md-4 text-md-right mt-3 mt-md-0 d-none d-md-block">
             <div class="date-badge">
                 <i class="far fa-calendar-alt mr-2"></i> <?= date('F d, Y') ?>
             </div>
          </div>
        </div>
        <div class="banner-shape shape-1"></div>
        <div class="banner-shape shape-2"></div>
      </div>
    </div>
  </div>

  <section class="content mt-2">
    <div class="container-fluid">
      
      <div class="row">
        
        <div class="col-lg-3 col-6 animate-fade-up" style="animation-delay: 0.1s;">
          <div class="dash-card premium-gradient-1">
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <p class="dash-label">Total Students</p>
                  <h3 class="dash-number"><?= number_format($total_students ?? 0) ?></h3>
                </div>
                <div class="dash-icon-wrapper glass-icon">
                  <i class="fas fa-user-graduate"></i>
                </div>
              </div>
            </div>
            <a href="<?= base_url('students') ?>" class="dash-footer">
              <span>View Directory</span> <i class="fas fa-arrow-right"></i>
            </a>
            <i class="fas fa-user-graduate bg-icon"></i>
          </div>
        </div>

        <div class="col-lg-3 col-6 animate-fade-up" style="animation-delay: 0.2s;">
          <div class="dash-card premium-gradient-2">
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <p class="dash-label">Total Teachers</p>
                  <h3 class="dash-number"><?= number_format($total_teachers ?? 0) ?></h3>
                </div>
                <div class="dash-icon-wrapper glass-icon">
                  <i class="fas fa-chalkboard-teacher"></i>
                </div>
              </div>
            </div>
            <a href="<?= base_url('teacher') ?>" class="dash-footer">
              <span>Manage Teachers</span> <i class="fas fa-arrow-right"></i>
            </a>
            <i class="fas fa-chalkboard-teacher bg-icon"></i>
          </div>
        </div>

        <div class="col-lg-3 col-6 animate-fade-up" style="animation-delay: 0.3s;">
          <div class="dash-card premium-gradient-3">
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <p class="dash-label">Active Subjects</p>
                  <h3 class="dash-number"><?= number_format($total_subjects ?? 0) ?></h3>
                </div>
                <div class="dash-icon-wrapper glass-icon">
                  <i class="fas fa-book"></i>
                </div>
              </div>
            </div>
            <a href="<?= base_url('subject') ?>" class="dash-footer">
              <span>Manage Subjects</span> <i class="fas fa-arrow-right"></i>
            </a>
            <i class="fas fa-book bg-icon"></i>
          </div>
        </div>

        <div class="col-lg-3 col-6 animate-fade-up" style="animation-delay: 0.4s;">
          <div class="dash-card premium-gradient-4">
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <p class="dash-label">System Users</p>
                  <h3 class="dash-number"><?= number_format($total_users ?? 0) ?></h3>
                </div>
                <div class="dash-icon-wrapper glass-icon">
                  <i class="fas fa-user-shield"></i>
                </div>
              </div>
            </div>
            <a href="<?= base_url('users') ?>" class="dash-footer">
              <span>Manage Accounts</span> <i class="fas fa-arrow-right"></i>
            </a>
            <i class="fas fa-user-shield bg-icon"></i>
          </div>
        </div>

      </div> 
      
      <div class="row mt-4 animate-fade-up" style="animation-delay: 0.5s;">
        <div class="col-md-12">
            <div class="card premium-panel">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-light-warning mr-3">
                            <i class="fas fa-bolt text-warning"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 font-weight-bold text-dark">Quick Actions</h5>
                            <span class="text-muted text-sm">Rapid access to common tasks</span>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="<?= base_url('teacher') ?>" class="btn btn-premium-primary rounded-pill px-4 py-2 mr-2"><i class="fas fa-plus mr-2"></i>Add Teacher</a>
                        <a href="<?= base_url('subject') ?>" class="btn btn-premium-secondary rounded-pill px-4 py-2"><i class="fas fa-plus mr-2"></i>Add Subject</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
      

      <div class="row mt-4 animate-fade-up" style="animation-delay: 0.6s;">
        
        <div class="col-lg-8 mb-4">
            <div class="card premium-panel h-100">
                <div class="card-header border-0 bg-white pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="card-title font-weight-bold text-dark mb-0">
                        Population Overview
                    </h5>
                    <div class="chart-badge text-primary bg-primary-light">Current Academic Year</div>
                </div>
                <div class="card-body p-4 pt-0">
                    <canvas id="populationChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card premium-panel h-100">
                <div class="card-header border-0 bg-white pt-4 pb-2 px-4">
                    <h5 class="card-title font-weight-bold text-dark mb-0">
                        Data Distribution
                    </h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center p-4">
                    <canvas id="distributionChart" height="240"></canvas>
                </div>
            </div>
        </div>

      </div>

    </div>
  </section>
</div>

<style>
/* Modern Base */
.bg-light-modern { background-color: #f8f9fa !important; }

/* Welcome Banner */
.welcome-banner {
    background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    border-radius: 24px;
    padding: 30px 40px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(15, 32, 39, 0.15);
}
.date-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    color: #fff;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: 500;
    border: 1px solid rgba(255,255,255,0.1);
}
.banner-shape {
    position: absolute;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
}
.shape-1 { width: 300px; height: 300px; top: -100px; right: -50px; }
.shape-2 { width: 150px; height: 150px; bottom: -50px; right: 200px; }

/* The Premium Card Base */
.dash-card {
    border-radius: 24px;
    border: none;
    overflow: hidden;
    position: relative;
    color: #fff;
    margin-bottom: 30px;
    box-shadow: 0 12px 24px rgba(0,0,0,0.06);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 1;
}
.dash-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

/* Typography inside card */
.dash-label {
    font-size: 1.05rem;
    font-weight: 600;
    opacity: 0.85;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.dash-number {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 20px;
    line-height: 1;
}

/* Glassmorphism Icon */
.glass-icon {
    background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    width: 65px;
    height: 65px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: inset 0 0 20px rgba(255,255,255,0.1);
}

/* Bottom Footer Link */
.dash-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 24px;
    background: rgba(0, 0, 0, 0.12);
    color: rgba(255,255,255,0.9);
    text-decoration: none !important;
    font-size: 0.95rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
}
.dash-footer:hover {
    background: rgba(0, 0, 0, 0.2);
    color: #fff;
    padding-right: 20px; /* Slight push animation */
}

/* Giant Faded Background Icon */
.bg-icon {
    position: absolute;
    right: -15px;
    bottom: 20px;
    font-size: 130px;
    opacity: 0.1;
    transform: rotate(-10deg);
    z-index: -1;
    transition: all 0.5s ease;
}
.dash-card:hover .bg-icon {
    transform: rotate(0deg) scale(1.15);
    opacity: 0.15;
}

/* SaaS Vibrant Gradients */
.premium-gradient-1 { background: linear-gradient(135deg, #3A1C71 0%, #D76D77 50%, #FFAF7B 100%); }
.premium-gradient-2 { background: linear-gradient(135deg, #1D976C 0%, #93F9B9 100%); }
.premium-gradient-3 { background: linear-gradient(135deg, #F09819 0%, #EDDE5D 100%); }
.premium-gradient-4 { background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%); }

/* Lower Panels */
.premium-panel {
    border-radius: 24px;
    border: 1px solid rgba(0,0,0,0.03);
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    transition: box-shadow 0.3s ease;
}
.premium-panel:hover {
    box-shadow: 0 15px 35px rgba(0,0,0,0.06);
}

/* Quick Action Elements */
.icon-box {
    width: 50px;
    height: 50px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
}
.bg-light-warning { background-color: rgba(255, 193, 7, 0.15); }

.btn-premium-primary {
    background: #4A00E0;
    color: white;
    border: none;
    box-shadow: 0 4px 15px rgba(74, 0, 224, 0.3);
    transition: all 0.3s;
}
.btn-premium-primary:hover {
    background: #3600a8;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(74, 0, 224, 0.4);
}
.btn-premium-secondary {
    background: #fff;
    color: #FF8008;
    border: 1px solid #FF8008;
    transition: all 0.3s;
}
.btn-premium-secondary:hover {
    background: #FF8008;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 128, 8, 0.3);
}

/* Chart Badges */
.chart-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}
.bg-primary-light { background-color: rgba(74, 0, 224, 0.1); }

/* Animations */
.animate-fade-up {
    animation: fadeUp 0.8s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    opacity: 0;
    transform: translateY(20px);
}
@keyframes fadeUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
</style>

<?= $this->endSection() ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Exact numbers from your PHP Controller
    const stats = {
        students: <?= $total_students ?? 0 ?>,
        teachers: <?= $total_teachers ?? 0 ?>,
        subjects: <?= $total_subjects ?? 0 ?>,
        users: <?= $total_users ?? 0 ?>
    };

    // --- 1. PREMIUM BAR CHART ---
    const ctxBar = document.getElementById('populationChart').getContext('2d');
    
    // Smooth modern gradient for bars
    let gradientPurple = ctxBar.createLinearGradient(0, 0, 0, 400);
    gradientPurple.addColorStop(0, 'rgba(102, 126, 234, 1)'); // Top
    gradientPurple.addColorStop(1, 'rgba(118, 7ba, 226, 0.6)'); // Bottom

    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Students', 'Teachers', 'Subjects', 'System Users'],
            datasets: [{
                label: 'Total Count',
                data: [stats.students, stats.teachers, stats.subjects, stats.users],
                backgroundColor: gradientPurple,
                hoverBackgroundColor: 'rgba(102, 126, 234, 0.8)',
                borderWidth: 0,
                borderRadius: 50, // Fully rounded modern bars
                barPercentage: 0.4,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 16,
                    titleFont: { size: 14, family: "'Inter', sans-serif" },
                    bodyFont: { size: 14, weight: 'bold' },
                    cornerRadius: 12,
                    displayColors: false,
                    yAlign: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [5, 5], color: 'rgba(0,0,0,0.04)', drawBorder: false },
                    ticks: { padding: 15, font: { weight: '500' }, color: '#64748b' }
                },
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { padding: 10, font: { weight: '600' }, color: '#475569' }
                }
            },
            animation: {
                y: { duration: 2000, easing: 'easeOutQuart' }
            }
        }
    });

    // --- 2. PREMIUM DOUGHNUT CHART ---
    const ctxPie = document.getElementById('distributionChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Students', 'Teachers', 'Subjects'],
            datasets: [{
                data: [stats.students, stats.teachers, stats.subjects],
                backgroundColor: [
                    '#3A1C71', // Purple
                    '#1D976C', // Green
                    '#F09819'  // Orange
                ],
                borderWidth: 5,
                borderColor: '#ffffff',
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '78%', 
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { 
                        padding: 25, 
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: { size: 13, weight: '600' },
                        color: '#475569'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 16,
                    cornerRadius: 12,
                    bodyFont: { size: 15, weight: 'bold' }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true,
                duration: 2000,
                easing: 'easeOutQuart'
            }
        }
    });
});
</script>