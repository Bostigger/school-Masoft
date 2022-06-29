<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Account\EmployeeAccountSalaryController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Account\Profit\ProfitController;
use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\EmployeeController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeMonthlySalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Report\AttendanceController;
use App\Http\Controllers\Backend\Report\IdCardGenerateController;
use App\Http\Controllers\Backend\Report\MarkeSheetController;
use App\Http\Controllers\Backend\Report\ResultsController;
use App\Http\Controllers\Backend\Setups\AssignSubjectController;
use App\Http\Controllers\Backend\Setups\DesignationController;
use App\Http\Controllers\Backend\Setups\ExamTypeController;
use App\Http\Controllers\Backend\Setups\FeeCategoryAmountController;
use App\Http\Controllers\Backend\Setups\FeeCategoryController;
use App\Http\Controllers\Backend\Setups\StudentClassController;
use App\Http\Controllers\Backend\Setups\StudentGroupController;
use App\Http\Controllers\Backend\Setups\StudentShiftController;
use App\Http\Controllers\Backend\Setups\StudentYearController;
use App\Http\Controllers\Backend\Setups\SubjectController;
use App\Http\Controllers\Backend\Students\ExamFeeOptionController;
use App\Http\Controllers\Backend\Students\MarksController;
use App\Http\Controllers\Backend\Students\MonthlyFeeController;
use App\Http\Controllers\Backend\Students\RollGeneratorController;
use App\Http\Controllers\Backend\Students\StudentController;
use App\Http\Controllers\Backend\Students\StudentGradeController;
use App\Http\Controllers\Backend\Students\StudentRegistrationFeeController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'prevent-back-history'],function() {
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');


    Route::group(['middleware' => 'auth'], function () {

        Route::prefix('admin')->group(function () {
            Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
            Route::get('/change-password', [AdminController::class, 'ChangePasswordPage'])->name('change.password')->middleware('auth');
            Route::post('/update-password', [AdminController::class, 'UpdatePassword'])->name('update.password')->middleware('auth');
            Route::get('/profile-page', [AdminController::class, 'ProfilePage'])->name('profile.page');
        });

//user management routes
        Route::prefix('users')->group(function () {
            Route::get('/all-users', [UserController::class, 'AllUsers'])->name('view.users');
            Route::get('/user/edit/{id}', [UserController::class, 'EditUser']);
            Route::post('/update/user/{id}', [UserController::class, 'UpdateUser']);
            Route::get('/user/delete/{id}', [UserController::class, 'DeleteUser']);
            Route::get('/user/Add-page/', [UserController::class, 'AddUserPage'])->name('add.user');
            Route::post('/user/Add/', [UserController::class, 'AddUser'])->name('add.new.user');

        });

        Route::prefix('setups')->group(function () {
            Route::get('/student-class', [StudentClassController::class, 'ViewStudentClass'])->name('view.student.class');
            Route::get('/student/new/class', [StudentClassController::class, 'AddStudentClassPage'])->name('add.student.page');
            Route::post('/student/new/add-class', [StudentClassController::class, 'AddStudentClass'])->name('add.student.class');
            Route::get('/student-class/edit/{id}', [StudentClassController::class, 'EditClassPage']);
            Route::post('/student-class/update/{id}', [StudentClassController::class, 'UpdateStudentClass']);
            Route::get('/student-class/delete/{id}', [StudentClassController::class, 'DeleteStudentClass']);


            //Student Year Management Route
            Route::get('/student-year', [StudentYearController::class, 'StudentYearPage'])->name('student.year.page');
            Route::get('/student-year/add-page', [StudentYearController::class, 'AddStudentYearPage'])->name('add.student.year.page');
            Route::post('/student-year/add', [StudentYearController::class, 'AddStudentYear'])->name('add.student.year');
            Route::get('/student-year/edit/{id}', [StudentYearController::class, 'EditStudentYear']);
            Route::post('/student-year/update/{id}', [StudentYearController::class, 'UpdateStudentYear']);
            Route::get('/student-year/delete/{id}', [StudentYearController::class, 'DeleteStudentYear']);

            //Student Group Management Route
            Route::get('/student-group', [StudentGroupController::class, 'ViewStudentGroup'])->name('view.student.group');
            Route::get('/student-group/add-page', [StudentGroupController::class, 'AddStudentGroupPage'])->name('add.student.group.page');
            Route::post('/student-group/add', [StudentGroupController::class, 'AddStudentGroup'])->name('add.student.group');
            Route::get('/student-group/edit/{id}', [StudentGroupController::class, 'EditStudentGroupPage']);
            Route::post('/student-group/update/{id}', [StudentGroupController::class, 'UpdateStudentGroup']);
            Route::get('/student-group/delete/{id}', [StudentGroupController::class, 'DeleteStudentGroup']);

            //Student Shift Management Routes
            Route::get('/student-shift', [StudentShiftController::class, 'ViewStudentShiftPage'])->name('view.student.shift');
            Route::get('/student-shift/add-page', [StudentShiftController::class, 'AddStudentShiftPage'])->name('add.student.shift.page');
            Route::post('/student-shift/add', [StudentShiftController::class, 'AddStudentShift'])->name('add.student.shift');
            Route::get('/student-shift/edit/{id}', [StudentShiftController::class, 'EditStudentShift']);
            Route::post('/student-shift/update/{id}', [StudentShiftController::class, 'UpdateStudentShift']);
            Route::get('/student-shift/delete/{id}', [StudentShiftController::class, 'DeleteStudentShift']);

            //Fee Category
            Route::get('/fee-category', [FeeCategoryController::class, 'ViewFeeCategory'])->name('view.fee.category');
            Route::get('/fee-category/add-page', [FeeCategoryController::class, 'AddFeeCategoryPage'])->name('add.fee.category.page');
            Route::post('/fee-category/add', [FeeCategoryController::class, 'AddFeeCategory'])->name('add.fee.category');
            Route::get('/fee-category/edit/{id}', [FeeCategoryController::class, 'EditFeeCategory']);
            Route::post('/fee-category/update/{id}', [FeeCategoryController::class, 'UpdateFeeCategory']);
            Route::get('/fee-category/delete/{id}', [FeeCategoryController::class, 'DeleteFeeCategory']);

            //Fee Category Amount
            Route::get('/fee-category-amount', [FeeCategoryAmountController::class, 'FeeCategoryAmountPage'])->name('view.fee.amount');
            Route::get('/fee-category-amount/add-page', [FeeCategoryAmountController::class, 'AddFeeCategoryAmountPage'])->name('add.fee.amount.page');
            Route::post('/fee-category-amount/add', [FeeCategoryAmountController::class, 'AddFeeCategoryAmount'])->name('add.fee.amount');
            Route::get('/fee-category-amount/edit/{fee_category_id}', [FeeCategoryAmountController::class, 'EditFeeCategoryAmountPage']);
            Route::post('/fee-category-amount/update/{fee_category_id}', [FeeCategoryAmountController::class, 'UpdateFeeCategoryAmount']);
            Route::get('/fee-category-amount/details/{fee_category_id}', [FeeCategoryAmountController::class, 'ViewFeeCategoryDetails']);

            //Exam type routes
            Route::get('/exam-type', [ExamTypeController::class, 'ViewExamType'])->name('view.exam.type');
            Route::get('/exam-type/add-page', [ExamTypeController::class, 'AddExamTypePage'])->name('add.exam.type.page');
            Route::post('/exam-type/add', [ExamTypeController::class, 'AddExamType'])->name('add.exam.type');
            Route::get('/exam-type/edit/{id}', [ExamTypeController::class, 'EditExamTypePage']);
            Route::post('/exam-type/update/{id}', [ExamTypeController::class, 'UpdateExamTypePage']);
            Route::get('/exam-type/delete/{id}', [ExamTypeController::class, 'DeleteExamType']);

            //Subject Routes
            Route::get('/student-subject', [SubjectController::class, 'ViewSubjects'])->name('view.subject');
            Route::get('/student-subject/add-page', [SubjectController::class, 'AddSubjectPage'])->name('add.subject.page');
            Route::post('/student-subject/add', [SubjectController::class, 'AddStudentSubject'])->name('add.subject');
            Route::get('/subject/edit/{id}', [SubjectController::class, 'EditSubjectPage']);
            Route::post('/subject/update/{id}', [SubjectController::class, 'UpdateSubject']);
            Route::get('/subject/delete/{id}', [SubjectController::class, 'DeleteSubject']);

            //Assign Subjects
            Route::get('/assign-subject', [AssignSubjectController::class, 'AssignSubjectPage'])->name('view.assign.subject');
            Route::get('/assign-subject/add-page', [AssignSubjectController::class, 'AddAssignSubjectPage'])->name('add.assign.subject.page');
            Route::post('/assign-subject/add', [AssignSubjectController::class, 'AddSubjectAssignment'])->name('add.subject.assignment');
            Route::get('/assign-subject/edit/{student_class_id}', [AssignSubjectController::class, 'EditSubjectAssignmentPage']);
            Route::post('/assign-subject/update/{student_class_id}', [AssignSubjectController::class, 'UpdateSubjectAssignment']);
            Route::get('/assign-subject/details/{student_class_id}', [AssignSubjectController::class, 'AssignmentDetailsPage']);

            //Designation Routes
            Route::get('/designate', [DesignationController::class, 'DesignationPage'])->name('view.designations');
            Route::get('/designate/add-page', [DesignationController::class, 'AddDesignationPage'])->name('add.designation.page');
            Route::post('/designate/add', [DesignationController::class, 'AddNewDesignation'])->name('add.designation');
            Route::get('/designate/edit/{id}', [DesignationController::class, 'EditDesignation']);
            Route::post('/designate/update/{id}', [DesignationController::class, 'UpdateDesignation']);
            Route::get('/designate/delete/{id}', [DesignationController::class, 'DeleteDesignation']);
        });

        Route::prefix('students')->group(function () {
            Route::get('/all-students', [StudentController::class, 'ViewStudentList'])->name('view.students');
            Route::get('/add-student', [StudentController::class, 'AddStudentPage'])->name('add.new.student.page');
            Route::post('/add-student/new/', [StudentController::class, 'AddNewStudent'])->name('add.new.student');
            Route::get('/search/student/', [StudentController::class, 'SearchStudents'])->name('search.student');
            Route::get('/edit/{student_id}', [StudentController::class, 'EditSearch']);
            Route::post('/update/{student_id}', [StudentController::class, 'UpdateUser']);
            Route::get('/promote/{student_id}', [StudentController::class, 'PromoteStudent'])->name('promote.student');
            Route::post('/promote/update/{student_id}', [StudentController::class, 'UpdateStudentPromotion']);
            Route::get('/details/{student_id}', [StudentController::class, 'GenerateStudentDetails']);

            //Student Roll Generates Routes
            Route::get('/roll/generate', [RollGeneratorController::class, 'RollGeneratePage'])->name('roll.generate.view');
            Route::get('/roll/view-students', [RollGeneratorController::class, 'GetAllStudents'])->name('get.all.students');
            Route::post('/roll/generate-roll/', [RollGeneratorController::class, 'InsertRoll']);
            Route::get('/registration/fee-page/', [StudentRegistrationFeeController::class, 'StudentReFeePage'])->name('student.reg.fee.page');
            Route::post('/registration/fee-page/get', [StudentRegistrationFeeController::class, 'GetRegFeesData'])->name('student.registration.fee.get');
            Route::get('/fee/payslip/student/{student_id}/class/{class_id}', [StudentRegistrationFeeController::class, 'GeneratePaySlip'])->name('student.registration.fee.payslip');

            Route::get('/monthly-fee/view', [MonthlyFeeController::class, 'ChooseMonthPage'])->name('monthly.fee.view');
            Route::post('/monthly-fee/select', [MonthlyFeeController::class, 'SelectMonthFeePage'])->name('monthly.fee.select');
            Route::get('/monthly-fee/payslip/student_id/{student_id}/class/{class_id}/month/{selected_month}', [MonthlyFeeController::class, 'GenerateMonthFeePayslip'])->name('monthly.fee.payslip');

            //Exam Fee Routes
            Route::get('/exam-fee/view', [ExamFeeOptionController::class, 'ExamFeeViewPage'])->name('exam.fee.option.view');
            Route::post('/exam-fee/fetched', [ExamFeeOptionController::class, 'FetchedExamType'])->name('fetched.fee.option.view');
            Route::get('/exam-fee/generate/payslip/student/{student_id}/class/{class_id}/exam/{name}', [ExamFeeOptionController::class, 'GenerateExamFeeSlip'])->name('exam.fees.payslip');


            //Student Marks Route

        });


        Route::prefix('employees')->group(function () {
            Route::get('/view-employees', [EmployeeController::class, 'ViewAllEmployees'])->name('view.employees');
            Route::get('/add-employee/page', [EmployeeController::class, 'AddEmpPage'])->name('add.employees.page');
            Route::post('/add-employee/new', [EmployeeController::class, 'AddEmployeeDetails'])->name('add.new.employee');
            Route::get('/edit/{id}', [EmployeeController::class, 'EditEmployeePage']);
            Route::post('/update/{id}', [EmployeeController::class, 'UpdateEmployeeDetails']);
            Route::get('/details/{id}', [EmployeeController::class, 'GetEmployeeDetails']);
            Route::get('/delete/{id}', [EmployeeController::class, 'DeleteEmployee']);

            //Manage salary
            Route::get('/manage-salary', [EmployeeSalaryController::class, 'ManageSalaryPage'])->name('view.employees.salary');
            Route::get('/manage-salary/view/{id}', [EmployeeSalaryController::class, 'ViewEmployeeSalaryPage']);
            Route::post('/update-salary/{employee_id}', [EmployeeSalaryController::class, 'UpdateSalary']);

            //Employee Leave
            Route::get('/leave-page', [EmployeeLeaveController::class, 'ViewEmpLeavePage'])->name('view.employee.leave');
            Route::get('/add-new-leave', [EmployeeLeaveController::class, 'AddNewLeavePage'])->name('add.new.leave.page');
            Route::post('/add-new-leave/add', [EmployeeLeaveController::class, 'AddNewLeave'])->name('add.new.leave');
            Route::get('/edit/{id}', [EmployeeLeaveController::class, 'EditEmployeeLeavePage']);
            Route::post('/update/{id}', [EmployeeLeaveController::class, 'UpdateEmployeeLeave']);
            Route::get('/delete/{id}', [EmployeeLeaveController::class, 'DeleteEmployeeLeave']);

            Route::get('/leave-purpose', [EmployeeLeaveController::class, 'AddLeavePurposePage'])->name('add.leave.purpose.page');
            Route::post('/leave-purpose/add', [EmployeeLeaveController::class, 'AddLeavePurpose'])->name('add.leave.purpose');

            Route::get('/view-attendance', [EmployeeAttendanceController::class, 'ViewAttendancePage'])->name('view.attendance.page');
            Route::post('/mark-attendance', [EmployeeAttendanceController::class, 'UpdateAttendance'])->name('save.employee.attendance');
            Route::get('/view-attendance/{date}', [EmployeeAttendanceController::class, 'ViewAttendance']);
            Route::post('/update-attendance/', [EmployeeAttendanceController::class, 'UpdateEmployeeAttendance'])->name('update.attendance');
            Route::get('/delete-attendance/{date}', [EmployeeAttendanceController::class, 'DeleteAttendance']);
            Route::get('/export-attendance/{date}', [EmployeeAttendanceController::class, 'ExportAttendance']);

            Route::get('/monthly-salary', [EmployeeMonthlySalaryController::class, 'FetchEmployees'])->name('view.monthly.salary.page');
            Route::get('/salary/due-monthly/{id}', [EmployeeMonthlySalaryController::class, 'GetEmployeesMonthlySalary']);
            Route::post('monthly/salary-slip/{id}', [EmployeeMonthlySalaryController::class, 'GenerateSlip']);
        });

        Route::prefix('marks')->group(function () {
            Route::get('/student-marks', [MarksController::class, 'AddMarksPage'])->name('student.marks.page');
            Route::get('/student-marks/get-subjects', [MarksController::class, 'GetSubjects'])->name('marks.get.subject');
            Route::get('/student-marks/get-students', [MarksController::class, 'FetchDetails'])->name('get.class.students');
            Route::post('/student-marks/add', [MarksController::class, 'InsertStudentMarks'])->name('insert.student.marks');
            Route::get('/student-marks/update', [MarksController::class, 'UpdateStudentMarks'])->name('student.marks.update');
            Route::get('/student-marks/update-marks/get', [MarksController::class, 'GetStudentMarks'])->name('get.previous.marks');
            Route::post('/student-marks/edit-marks', [MarksController::class, 'UpdateStudentsMark'])->name('edit.student.marks');

            //grades controller
            Route::get('grade', [StudentGradeController::class, 'ViewGradePage'])->name('view.grade.page');
            Route::get('grade/add', [StudentGradeController::class, 'AddGradePage'])->name('add.new.grade.page');
            Route::post('grade/add-new', [StudentGradeController::class, 'AddNewGrade'])->name('add.new.grade');
            Route::get('grade/edit/{id}', [StudentGradeController::class, 'EditGradePage']);
            Route::post('grade/update/{id}', [StudentGradeController::class, 'UpdateGrade']);
            Route::get('grade/delete/{id}', [StudentGradeController::class, 'DeleteGrade']);
        });


        Route::prefix('accounts')->group(function () {
            Route::get('/student-fee', [StudentFeeController::class, 'ViewStudentFee'])->name('view.student.fee');
            Route::get('/student-fee/add-page', [StudentFeeController::class, 'AddStudentFeePage'])->name('add.student.fee.page');
            Route::post('/student-fee/fetch-details', [StudentFeeController::class, 'FetchStudentDetails'])->name('fetch.student.fee.details');
            Route::post('/student-fee/insert/student-fees', [StudentFeeController::class, 'InsertStudentFees'])->name('insert.student.fees');

            //Employee Payments route
            Route::get('/employee/account-salary', [EmployeeAccountSalaryController::class, 'ViewEmployeeAccountSalary'])->name('view.employee.account.salary');
            Route::get('/employee/details-page', [EmployeeAccountSalaryController::class, 'SalaryPaymentPage'])->name('salary.payment.page');
            Route::post('/employee/details-page/get', [EmployeeAccountSalaryController::class, 'FetchEmployeeDetails'])->name('salary.payment.details.get');
            Route::post('/employee/details-page/update', [EmployeeAccountSalaryController::class, 'InsertEmployeePaymentDetails'])->name('salary.payment.details.insert');

            //other Cost
            Route::get('/other-cost', [OtherCostController::class, 'ViewOtherCostPage'])->name('view.other.cost.page');
            Route::get('/other-cost/add-page', [OtherCostController::class, 'AddOtherCostPage'])->name('add.other.cost.page');
            Route::post('/other-cost/add', [OtherCostController::class, 'AddOtherCost'])->name('add.other.cost');
            Route::get('/other-cost/edit/{id}', [OtherCostController::class, 'EditOtherCostPage']);
            Route::post('/other-cost/update/{id}', [OtherCostController::class, 'UpdateOtherCostPage']);
            Route::get('/other-cost/delete/{id}', [OtherCostController::class, 'DeleteOtherCostPage']);
        });

        Route::prefix('reports')->group(function () {
            Route::get('/profits', [ProfitController::class, 'ViewProfitPage'])->name('view.profit.page');
            Route::post('/profits/get-details', [ProfitController::class, 'FetchMonthlyDateRangeData'])->name('get.date.range');
            Route::get('/profit/view-details/startdate/{start_date}/enddate/{end_date}', [ProfitController::class, 'ViewProfitDetails'])->name('view.profit.details');

            //marks generate
            Route::get('/marks-generate', [MarkeSheetController::class, 'ViewMarksSheetPage'])->name('view.marks.generate.page');
            Route::get('/marks-generate/get', [MarkeSheetController::class, 'GetMarksSheetPage'])->name('get.students.marks.sheet');

            //Employee Attendance Report Route
            Route::get('/attendance-report', [AttendanceController::class, 'ViewEmployeeAttendanceReportPage'])->name('view.attendance.report.page');
            Route::get('/attendance-report/employee/get-details', [AttendanceController::class, 'GetEmployeeAttendanceDetails'])->name('get.employee.attendance.details');

            //Students Result routes
            Route::get('/student-result', [ResultsController::class, 'ViewResultsGeneratePage'])->name('view.results.generate.page');
            Route::get('/student-result/student/details/get', [ResultsController::class, 'GetStudentsDetails'])->name('student.results.details.get');

            //Student ID Generate Routes
            Route::get('/student-id/generate', [IdCardGenerateController::class, 'GenerateIDPage'])->name('generate.id.card.page');
            Route::get('/student-id/generate/details/get', [IdCardGenerateController::class, 'GetGenerateIDPage'])->name('generate.students.id.details');
        });


    });
});

require __DIR__.'/auth.php';
