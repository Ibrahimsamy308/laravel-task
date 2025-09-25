<?php

use App\Models\Admin;
use App\Models\Category;
use App\Models\Complain;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Counter;
use App\Models\Newsletter;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Project;
use App\Models\Page;
use App\Models\Team;
use App\Models\Task;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\Process;
use App\Models\Service;
use App\Models\Fee;
use App\Models\Setting;
use App\Models\User;
use App\Models\Product;
use App\Models\Vaccancy;
use App\Models\Video;
use Illuminate\Support\Facades\File;
use Jackiedo\Cart\Facades\Cart;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use App\Models\Exam;
use Illuminate\Support\Facades\DB;

const Message_Mail = "app@gmail.com";

const Newsletter_Mail = "app@gmail.com";
function settings()
{
    return Setting::first();
}

function page($identifier)
{
    return Page::where('identifier', $identifier)->first();
}

function upload_image($file)
{
    $path = $file->store('images');
    $file->move('images', $path);
    return $path;
}


function delete_file($file)
{
    if (file_exists($file))
        File::delete($file);
}

function successResponse($data = [], $message = "success", $status = 200)
{
    return response()->json(
        [
            "status" => $status,
            "message" => $message,
            "data" => $data,
        ],
        $status
    );
}

function failedResponse($data = [], $message = "error", $status = 400)
{
    return response()->json(
        [
            "status" => $status,
            "message" => $message,
            "data" => $data,
        ],
        $status
    );
}

function itemsCount($model)
{
   
    $items = [
        "faqs" => count(Faq::get()),
        "messages" => count(Message::get()),
        "counters" => count(Counter::get()),
        "newsletters" => count(Newsletter::get()),
        "contacts" => count(Contact::get()),
        "Portfolios" => count(Gallery::get()),
        "images" => count(Image::get()),
        "pages" => count(Page::get()),
        "projects" => count(Project::get()),
        "teams" => count(Team::get()),
        "fees" => count(Fee::get()),
        "finishedFees" => count(Fee::get()),
        "partners" => count(Partner::get()),
        "services" => count(Service::get()),
        "testimonials" => count(Testimonial::get()),
        "processes" => count(Process::get()),
        "partners" => count(Partner::get()),
        "products" => count(Product::get()),
        "users" => count(User::get()),
        "complains" => count(Complain::get()),
        "vaccancies" => count(Vaccancy::get()),

        "admins" => count(Admin::get()),
        "videos" => count(Video::get()),
        "roles" => count(Role::get()),
        "categories" => count(Category::get()),
        "instructors" => count(Admin::where('type','instructor')->get()),
        "courses" => count(Course::get()),
    ];


    return $items[$model];
}

function services()
{
    $services = Service::latest()->take(6)->get();

    return $services;
}


function courses()
{
    $courses = Course::latest()->take(14)->get();

    return $courses;
}
function rest($project)
{
    $totalFee=0;
    foreach($project->fees as $fee){
        if($fee->amount>0)
        $totalFee+=$fee->amount;
    }
    return $project->cost-$totalFee;
}

if (! function_exists('getCoursesBySort')) {
    function getCoursesBySort($sortBy = 'price_desc', $limit = 5)
    {
        $query = Course::query();

        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            case 'most_lessons':
                $query->withCount('lessons')->orderBy('lessons_count', 'desc');
                break;

            case 'most_students':
                $query->withCount('students')->orderBy('students_count', 'desc');
                break;

            default:
                $query->latest(); // الافتراضي بالـ created_at
        }

        return $query->take($limit)->get();
    }
}

// if (! function_exists('getRecentExamStats')) {
//     function getRecentExamStats($limit = 5)
//     {
//         // نجيب آخر امتحانات
//         $exams = Exam::with(['users' => function ($q) {
//                 $q->withPivot('score');
//             }])
//             ->latest()
//             ->take($limit)
//             ->get();

//         // نجهز الإحصائيات
//         return $exams->map(function ($exam) {
//             $users = $exam->users;

//             $totalStudents = $users->count();
//             $averageScore = $users->avg(fn($u) => $u->pivot->score);

//             // top student في نفس الامتحان
//             $mostActive = DB::table('userexams')
//                 ->select('user_id', DB::raw('COUNT(*) as total'))
//                 ->where('exam_id', $exam->id)
//                 ->groupBy('user_id')
//                 ->orderByDesc('total')
//                 ->first();

//             return [
//                 'exam_title'      => $exam->title,
//                 'exam_date'       => $exam->created_at->format('Y-m-d'),
//                 'students_count'  => $totalStudents,
//                 'average_score'   => round($averageScore, 2),
//                 'top_user'        => $mostActive ? User::find($mostActive->user_id)?->name : null,
//                 'top_user_count'  => $mostActive?->total ?? 0,
//             ];
//         });
//     }
// }

function getSortedExams()
{
    $sort = request('sort', 'new'); // default = new
    $query = Exam::withCount('users')->with('users');

    switch ($sort) {
        case 'old':
            $query->orderBy('created_at', 'asc');
            break;
        case 'most_students':
            $query->orderBy('users_count', 'desc');
            break;
        default: // new
            $query->orderBy('created_at', 'desc');
            break;
    }

    return $query->take(7)->get();
}


function taskEmployees($title){
    $employee_ids=Task::where('title',$title)->pluck('employee_id');
    $names=Admin::whereIn('id',$employee_ids)->pluck('name');
    return json_encode($names);
}

function products()
{
    $products = Product::latest()->take(6)->get();

    return $products;
}



if (!function_exists('cart')) {

    function cart()
    {

        return Cart::name('shopping')->useForCommercial();
    }
}

if (!function_exists('tasks')) {

    function tasks($type)
    {
        return isset($type) ?  Task::where('type', $type)->get() : Task::latest()->get();;
    }
}

if (!function_exists('task')) {

    function task($type)
    {
      Task::where('type', $type)->first();
    }
}
if (!function_exists('favourite')) {

    function favourite()
    {
        return cart()->newInstance('favourites')->useForCommercial(false);
    }
}

if (!function_exists('contacts')) {

    function contacts($type)
    {
        return isset($type) ?  Contact::where('type', $type)->get() : Contact::latest()->get();;
    }
}

if (!function_exists('contact')) {

    function contact($type)
    {
      Contact::where('type', $type)->first();
    }
}

    if (!function_exists('validationFailedResponse')) {
        function validationFailedResponse($errors)
        {
            return new JsonResponse([
                'status' => 420,
                'message' => 'error',
                'errors' => $errors
            ], 420);
        }
    }

// if (!function_exists('projects')) {

//     function projects($type)
//     {
//         return isset($type) ?  Project::where('type', $type)->get() : Project::latest()->get();;
//     }
// }

// if (!function_exists('project')) {

//     function project($type)
//     {
//       Project::where('type', $type)->first();
//     }
// }