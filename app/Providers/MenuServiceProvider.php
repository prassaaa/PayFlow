<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class MenuServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('menuItems', $this->getMenuItems());
        });
    }

    private function getMenuItems(): array
    {
        if (!Auth::check()) {
            return [];
        }

        $user = Auth::user();
        $menuItems = [];

        // Dashboard - Available to all authenticated users
        if ($user->can('view_dashboard')) {
            $menuItems[] = [
                'name' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h6a1 1 0 001-1v-6a1 1 0 00-1-1h-6z',
                'active' => request()->routeIs('dashboard'),
            ];
        }

        // Master Data - HR roles only
        if ($user->can('view_master_data')) {
            $masterDataItems = [];
            
            if ($user->can('create_company') || $user->can('edit_company')) {
                $masterDataItems[] = [
                    'name' => 'Perusahaan',
                    'route' => 'master.companies.index',
                    'active' => request()->routeIs('master.companies.*'),
                ];
            }
            
            if ($user->can('create_department') || $user->can('edit_department')) {
                $masterDataItems[] = [
                    'name' => 'Departemen',
                    'route' => 'master.departments.index',
                    'active' => request()->routeIs('master.departments.*'),
                ];
            }
            
            if ($user->can('create_position') || $user->can('edit_position')) {
                $masterDataItems[] = [
                    'name' => 'Jabatan',
                    'route' => 'master.positions.index',
                    'active' => request()->routeIs('master.positions.*'),
                ];
            }
            
            if ($user->can('manage_holidays')) {
                $masterDataItems[] = [
                    'name' => 'Hari Libur',
                    'route' => 'master.holidays.index',
                    'active' => request()->routeIs('master.holidays.*'),
                ];
            }
            
            if ($user->can('manage_salary_components')) {
                $masterDataItems[] = [
                    'name' => 'Komponen Gaji',
                    'route' => 'master.salary-components.index',
                    'active' => request()->routeIs('master.salary-components.*'),
                ];
            }

            if (!empty($masterDataItems)) {
                $menuItems[] = [
                    'name' => 'Master Data',
                    'icon' => 'M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z',
                    'submenu' => $masterDataItems,
                    'active' => request()->routeIs('master.*'),
                ];
            }
        }

        // Employee Management - HR roles only
        if ($user->can('view_employees')) {
            $employeeItems = [];
            
            $employeeItems[] = [
                'name' => 'Data Karyawan',
                'route' => 'employees.index',
                'active' => request()->routeIs('employees.*'),
            ];
            
            if ($user->can('manage_contracts')) {
                $employeeItems[] = [
                    'name' => 'Kontrak Kerja',
                    'route' => 'employees.contracts.index',
                    'active' => request()->routeIs('employees.contracts.*'),
                ];
            }

            $menuItems[] = [
                'name' => 'Manajemen Karyawan',
                'icon' => 'M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z',
                'submenu' => $employeeItems,
                'active' => request()->routeIs('employees.*'),
            ];
        }

        // Attendance - HR and Employee access
        if ($user->can('view_attendance')) {
            $attendanceItems = [];
            
            $attendanceItems[] = [
                'name' => 'Data Kehadiran',
                'route' => 'attendance.index',
                'active' => request()->routeIs('attendance.index'),
            ];
            
            if ($user->can('manage_schedules')) {
                $attendanceItems[] = [
                    'name' => 'Jadwal Kerja',
                    'route' => 'attendance.schedules.index',
                    'active' => request()->routeIs('attendance.schedules.*'),
                ];
            }
            
            $attendanceItems[] = [
                'name' => 'Koreksi Absensi',
                'route' => 'attendance.corrections.index',
                'active' => request()->routeIs('attendance.corrections.*'),
            ];

            $menuItems[] = [
                'name' => 'Absensi',
                'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z',
                'submenu' => $attendanceItems,
                'active' => request()->routeIs('attendance.*'),
            ];
        }

        // Leave Management - HR and Employee access
        if ($user->can('view_leaves') || $user->can('view_own_leaves')) {
            $leaveItems = [];
            
            if ($user->can('view_leaves')) {
                $leaveItems[] = [
                    'name' => 'Data Cuti',
                    'route' => 'leaves.index',
                    'active' => request()->routeIs('leaves.index'),
                ];
                
                $leaveItems[] = [
                    'name' => 'Persetujuan Cuti',
                    'route' => 'leaves.approvals.index',
                    'active' => request()->routeIs('leaves.approvals.*'),
                ];
            }
            
            if ($user->can('create_own_leave') || $user->can('view_own_leaves')) {
                $leaveItems[] = [
                    'name' => 'Cuti Saya',
                    'route' => 'leaves.my-leaves.index',
                    'active' => request()->routeIs('leaves.my-leaves.*'),
                ];
            }

            $menuItems[] = [
                'name' => 'Manajemen Cuti',
                'icon' => 'M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z',
                'submenu' => $leaveItems,
                'active' => request()->routeIs('leaves.*'),
            ];
        }

        // Payroll - HR and Finance access
        if ($user->can('view_payroll')) {
            $payrollItems = [];
            
            $payrollItems[] = [
                'name' => 'Proses Gaji',
                'route' => 'payroll.process.index',
                'active' => request()->routeIs('payroll.process.*'),
            ];
            
            $payrollItems[] = [
                'name' => 'Riwayat Gaji',
                'route' => 'payroll.history.index',
                'active' => request()->routeIs('payroll.history.*'),
            ];
            
            if ($user->can('manage_tax_settings')) {
                $payrollItems[] = [
                    'name' => 'Pengaturan PPh 21',
                    'route' => 'payroll.tax-settings.index',
                    'active' => request()->routeIs('payroll.tax-settings.*'),
                ];
            }
            
            if ($user->can('manage_bpjs_settings')) {
                $payrollItems[] = [
                    'name' => 'Pengaturan BPJS',
                    'route' => 'payroll.bpjs-settings.index',
                    'active' => request()->routeIs('payroll.bpjs-settings.*'),
                ];
            }

            $menuItems[] = [
                'name' => 'Payroll',
                'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V16h-2.82v2.09c-1.96-.4-3.5-1.94-3.9-3.9H8.78v-2.82H6.91c.4-1.96 1.94-3.5 3.9-3.9V9.55h2.82V7.46c1.96.4 3.5 1.94 3.9 3.9h1.87v2.82h1.87c-.4 1.96-1.94 3.5-3.9 3.9z',
                'submenu' => $payrollItems,
                'active' => request()->routeIs('payroll.*'),
            ];
        }

        // Claims - All authenticated users can access
        if ($user->can('view_claims') || $user->can('view_own_claims')) {
            $claimItems = [];
            
            if ($user->can('view_claims')) {
                $claimItems[] = [
                    'name' => 'Data Klaim',
                    'route' => 'claims.index',
                    'active' => request()->routeIs('claims.index'),
                ];
                
                $claimItems[] = [
                    'name' => 'Persetujuan Klaim',
                    'route' => 'claims.approvals.index',
                    'active' => request()->routeIs('claims.approvals.*'),
                ];
            }
            
            if ($user->can('create_own_claim') || $user->can('view_own_claims')) {
                $claimItems[] = [
                    'name' => 'Klaim Saya',
                    'route' => 'claims.my-claims.index',
                    'active' => request()->routeIs('claims.my-claims.*'),
                ];
            }

            $menuItems[] = [
                'name' => 'Klaim',
                'icon' => 'M20 8H4V6c0-1.1.9-2 2-2h12c1.1 0 2 .9 2 2v2zm0 2v8c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2v-8h16zM8 12h2v2H8v-2zm4 0h2v2h-2v-2z',
                'submenu' => $claimItems,
                'active' => request()->routeIs('claims.*'),
            ];
        }

        // Reports - HR and Finance access
        if ($user->can('view_reports')) {
            $reportItems = [];
            
            if ($user->can('view_salary_reports')) {
                $reportItems[] = [
                    'name' => 'Laporan Gaji',
                    'route' => 'reports.salary.index',
                    'active' => request()->routeIs('reports.salary.*'),
                ];
            }
            
            if ($user->can('view_attendance_reports')) {
                $reportItems[] = [
                    'name' => 'Laporan Absensi',
                    'route' => 'reports.attendance.index',
                    'active' => request()->routeIs('reports.attendance.*'),
                ];
            }
            
            if ($user->can('view_tax_reports')) {
                $reportItems[] = [
                    'name' => 'Laporan PPh 21',
                    'route' => 'reports.tax.index',
                    'active' => request()->routeIs('reports.tax.*'),
                ];
            }
            
            if ($user->can('view_bpjs_reports')) {
                $reportItems[] = [
                    'name' => 'Laporan BPJS',
                    'route' => 'reports.bpjs.index',
                    'active' => request()->routeIs('reports.bpjs.*'),
                ];
            }

            if (!empty($reportItems)) {
                $menuItems[] = [
                    'name' => 'Laporan',
                    'icon' => 'M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z',
                    'submenu' => $reportItems,
                    'active' => request()->routeIs('reports.*'),
                ];
            }
        }

        // Employee Self Service - Employee access
        if ($user->can('view_own_profile')) {
            $essItems = [];
            
            $essItems[] = [
                'name' => 'Profil Saya',
                'route' => 'profile.edit',
                'active' => request()->routeIs('profile.edit'),
            ];
            
            if ($user->can('view_own_payslip')) {
                $essItems[] = [
                    'name' => 'Slip Gaji Saya',
                    'route' => 'ess.payslips.index',
                    'active' => request()->routeIs('ess.payslips.*'),
                ];
            }

            $menuItems[] = [
                'name' => 'Portal Karyawan',
                'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z',
                'submenu' => $essItems,
                'active' => request()->routeIs('ess.*') || request()->routeIs('profile.*'),
            ];
        }

        // System Settings - Super Admin only
        if ($user->can('manage_system_settings')) {
            $settingsItems = [];
            
            if ($user->can('manage_users')) {
                $settingsItems[] = [
                    'name' => 'Manajemen User',
                    'route' => 'settings.users.index',
                    'active' => request()->routeIs('settings.users.*'),
                ];
            }
            
            if ($user->can('manage_roles')) {
                $settingsItems[] = [
                    'name' => 'Manajemen Role',
                    'route' => 'settings.roles.index',
                    'active' => request()->routeIs('settings.roles.*'),
                ];
            }
            
            if ($user->can('view_activity_logs')) {
                $settingsItems[] = [
                    'name' => 'Log Aktivitas',
                    'route' => 'settings.activity-logs.index',
                    'active' => request()->routeIs('settings.activity-logs.*'),
                ];
            }

            if (!empty($settingsItems)) {
                $menuItems[] = [
                    'name' => 'Pengaturan Sistem',
                    'icon' => 'M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z',
                    'submenu' => $settingsItems,
                    'active' => request()->routeIs('settings.*'),
                ];
            }
        }

        return $menuItems;
    }
}