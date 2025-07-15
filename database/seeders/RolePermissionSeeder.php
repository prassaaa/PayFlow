<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Dashboard
            'view_dashboard',
            
            // Master Data
            'view_master_data',
            'create_company',
            'edit_company',
            'delete_company',
            'create_department',
            'edit_department',
            'delete_department',
            'create_position',
            'edit_position',
            'delete_position',
            'manage_holidays',
            'manage_salary_components',
            
            // Employee Management
            'view_employees',
            'create_employee',
            'edit_employee',
            'delete_employee',
            'view_employee_details',
            'manage_contracts',
            
            // Attendance
            'view_attendance',
            'create_attendance',
            'edit_attendance',
            'delete_attendance',
            'manage_schedules',
            'approve_attendance_corrections',
            
            // Leave Management
            'view_leaves',
            'create_leave',
            'edit_leave',
            'delete_leave',
            'approve_leave',
            'reject_leave',
            
            // Payroll
            'view_payroll',
            'create_payroll',
            'edit_payroll',
            'delete_payroll',
            'process_payroll',
            'manage_tax_settings',
            'manage_bpjs_settings',
            
            // Claims/Reimbursement
            'view_claims',
            'create_claim',
            'edit_claim',
            'delete_claim',
            'approve_claim',
            'reject_claim',
            
            // Reports
            'view_reports',
            'export_reports',
            'view_salary_reports',
            'view_attendance_reports',
            'view_tax_reports',
            'view_bpjs_reports',
            
            // Employee Self Service
            'view_own_profile',
            'edit_own_profile',
            'view_own_payslip',
            'view_own_leaves',
            'create_own_leave',
            'view_own_claims',
            'create_own_claim',
            
            // System Settings
            'manage_users',
            'manage_roles',
            'view_activity_logs',
            'manage_system_settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Super Admin - Full access
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->syncPermissions(Permission::all());

        // HR Manager - Most HR functions
        $hrManager = Role::firstOrCreate(['name' => 'hr_manager']);
        $hrManager->syncPermissions([
            'view_dashboard',
            'view_master_data',
            'create_company', 'edit_company', 'delete_company',
            'create_department', 'edit_department', 'delete_department',
            'create_position', 'edit_position', 'delete_position',
            'manage_holidays', 'manage_salary_components',
            'view_employees', 'create_employee', 'edit_employee', 'delete_employee',
            'view_employee_details', 'manage_contracts',
            'view_attendance', 'create_attendance', 'edit_attendance', 'delete_attendance',
            'manage_schedules', 'approve_attendance_corrections',
            'view_leaves', 'create_leave', 'edit_leave', 'delete_leave',
            'approve_leave', 'reject_leave',
            'view_payroll', 'create_payroll', 'edit_payroll', 'delete_payroll',
            'process_payroll', 'manage_tax_settings', 'manage_bpjs_settings',
            'view_claims', 'create_claim', 'edit_claim', 'delete_claim',
            'approve_claim', 'reject_claim',
            'view_reports', 'export_reports', 'view_salary_reports',
            'view_attendance_reports', 'view_tax_reports', 'view_bpjs_reports',
            'manage_users', 'manage_roles', 'view_activity_logs',
        ]);

        // HR Staff - Limited HR functions
        $hrStaff = Role::firstOrCreate(['name' => 'hr_staff']);
        $hrStaff->syncPermissions([
            'view_dashboard',
            'view_master_data',
            'view_employees', 'create_employee', 'edit_employee',
            'view_employee_details', 'manage_contracts',
            'view_attendance', 'create_attendance', 'edit_attendance',
            'view_leaves', 'create_leave', 'edit_leave',
            'approve_leave', 'reject_leave',
            'view_payroll', 'create_payroll', 'edit_payroll',
            'view_claims', 'create_claim', 'edit_claim',
            'approve_claim', 'reject_claim',
            'view_reports', 'export_reports',
        ]);

        // Finance - Payroll focused
        $finance = Role::firstOrCreate(['name' => 'finance']);
        $finance->syncPermissions([
            'view_dashboard',
            'view_payroll', 'create_payroll', 'edit_payroll', 'delete_payroll',
            'process_payroll', 'manage_tax_settings', 'manage_bpjs_settings',
            'view_claims', 'approve_claim', 'reject_claim',
            'view_reports', 'export_reports', 'view_salary_reports',
            'view_tax_reports', 'view_bpjs_reports',
        ]);

        // Employee - Self service only
        $employee = Role::firstOrCreate(['name' => 'employee']);
        $employee->syncPermissions([
            'view_dashboard',
            'view_own_profile', 'edit_own_profile',
            'view_own_payslip', 'view_own_leaves', 'create_own_leave',
            'view_own_claims', 'create_own_claim',
        ]);
    }
}