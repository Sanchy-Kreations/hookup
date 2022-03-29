<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Country;
use App\Models\Settings;
use App\Models\SubModule;
use App\Models\Subscription;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class PagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //run 4 queries from database tables
        
    if(Auth::user()){
   Redirect::url('');
    }else{
        return view('pages.index');
    }
    
    }


    public function escort($id){
        $settings = Settings::all();
        $content = Content::all();
        $users = User::where('id', $id)->get();
        $charges = Charges::where('uid', $id)->get();
        $gallery = Gallery::where('uid', $id)->get();
        $statistic = Statistic::where('uid', $id)->get();
        return view('home.escort', ['settings' => $settings, 'contents' => $content, 'users' => $users, 'charges' => $charges, 'galleries' => $gallery, 'statistics' => $statistic, 'uid' => $id]);

    }

    public function male_escorts(){
        $settings = Settings::all();
        
        $content = Content::all();
        
        $users = User::where('gender', 'Male')->get(); 
       
    return view('pages.male-escorts', ['settings' => $settings, 'contents' => $content, 'users' => $users]); 
    }

    public function female_escorts(){
        $settings = Settings::all();
        
        $content = Content::all();
        
        $users = User::where('gender', 'Female')->get(); 
       
    return view('pages.female-escorts', ['settings' => $settings, 'contents' => $content, 'users' => $users]); 
    }

    public function verified_escorts(){
        $settings = Settings::all();
        
        $content = Content::all();
        
        $users = User::where('verified', 1)->get(); 
       
    return view('pages.verified-escorts', ['settings' => $settings, 'contents' => $content, 'users' => $users]); 
    }

    public function escorts_on_travel(){
        $settings = Settings::all();

        $content = Content::all();
        
        $users = User::where('on_travel', 1)->get(); 
       
    return view('pages.escorts-on-travel', ['settings' => $settings, 'contents' => $content, 'users' => $users]); 
    }

    public function pool_party(){
        $settings = Settings::all();
        
        $content = Content::all();
       
    return view('pages.pool-party', ['settings' => $settings, 'contents' => $content]); 
    }

    public function beach_cruse(){
        $settings = Settings::all();
        
        $content = Content::all();
       
    return view('pages.beach-cruse', ['settings' => $settings, 'contents' => $content]); 
    }
   


    public function blog(){
        $info = Info::all();
        $services = Service::all();
        $blog = Blog::all();
        return view('pages.blog', ['services' => $services, 'blogs' => $blog, 'infos' => $info]);  
    }

    public function blog_detail($id){
        if($id != ""){
            $info = Info::all();
            $services = Service::all();
            $blog = Blog::where('id', $id)->get();
            return view('pages.blog-detail', ['services' => $services, 'blogs' => $blog, 'infos' => $info]); 
           }
    }

    public function service($id){
         if($id != ""){
            $info = Info::all();
            $services = Service::where('id', $id)->get();
            $subServices = SubService::where('ser_id', $id)->get();
            return view('pages.service', ['services' => $services, 'subServices' => $subServices, 'infos' => $info]);
         }
    }

    public function services(){
        $info = Info::all();
        $services = Service::all();
        return view('pages.services', ['services' => $services, 'infos' => $info]);
    }


    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }

    

    public function dashboard(){
        if(Auth::user() && Auth::user()->user_type == "admin" && Auth::user()->role == 1){
            $settings = Settings::where('id', 1)->get();
            $content = Content::all();
            $services = Services::all();
            $resort = Shelter::orderBy('id', 'desc')->get();
            $blog = Blog::all();
            $myself = User::where('id', Auth::user()->id)->get();
            $mem = User::where('user_type', 'member')->get();
            $user = User::all();
            $reservation = Reservations::where('opened', 0)->get();
                return view('home.member_dashboard', ['settings' => $settings, 'myselfs' => $myself, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog, 'members' => $mem, 'users' => $user, 'reservations' => $reservation]);
            }else{
            
                $error = array("code" => "403",
                               "title" => "Forbidden!",
                               "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                               "link" => url('/') );
                               return view('home.error', ['errors' => $error]); 
    
            }
    }

    public function serviceForm(){
        if(!Auth::user()){
            $this->index();
            }else{
        $services = Service::where('user',Auth::user()->email)->get();
        return view('home.services', ['services' => $services]);
            }
    }

    public function editService( $id ){
        if($id != Auth::user()->id){
        return view('home.error_404');
            }else{
        $services = Service::where('id', $id)->get();
        return view('home.edit-service', ['services' => $services]);
            }
    }

    public function subServiceForm( $id ){
        if(!Auth::user()){
            $this->index();
            }else{
        $services = Service::where('id', $id)->get();
        $subServices = SubService::where('ser_id', $id)->get();
        return view('home.sub-service', ['services' => $services, 'subServices' => $subServices]);
            }
    }

    public function newUser(){
        if(!Auth::user()){
            $this->index();
            }else{
        $users = User::all();
        return view('home.users', ['users' => $users]);
            }
    }

    public function user_edit_form( $id ){
        if(!Auth::user()){
            $this->index();
            }else{
        $users = User::where('id', $id)->get();
        return view('home.edit-users', ['users' => $users]);
            }
    }

    public function content(){
        if(!Auth::user()){
            $this->index();
            }else{
        $content = Content::all();
        return view('home.content', ['contents' => $content]);
            }
    }

    public function newsLetterForm(){
        if(!Auth::user()){
            $this->index();
            }else{
        $newsLetters = MailLetter::orderBy('created_at','desc')->paginate(10);
        return view('home.news-letter', ['newsLetters' => $newsLetters]);
            }
    }

    public function messages(){
        if(!Auth::user()){
            $this->index();
            }else{
        $support = Support::orderBy('created_at','desc')->get();
        return view('home.messages', ['messages' => $support]);
            }
    }

    public function readMessage( $id ){
        if(!Auth::user()){
            $this->index();
            }else{
        $support = Support::where('id', $id)->get();
        return view('home.read-message', ['messages' => $support]);
            }
    }

     public function service_request(){
        if(!Auth::user()){
            $this->index();
            }else{
        $requests = ServiceRequest::orderBy('created_at', 'desc')->get();
        return view('home.request', ['requests' => $requests]);
            }
     }

     public function read_request( $id ){
        if(!Auth::user()){
            $this->index();
            }else{
        $requests = ServiceRequest::where('id', $id)->get();
        return view('home.read-request', ['requests' => $requests]);
            }
     }

     public function site_info(){
        if(!Auth::user()){
            $this->index();
            }else{
        $infos = Info::where('id', 1)->get();
        return view('home.info', ['infos' => $infos]);
            }
     }

     public function userProfile( $id ){
            if($id != Auth::user()->id){
            return view('home.error_403');  
            }else{
            $user = User::where('id', $id)->get();
            return view('home.profile', ['users' => $user]);   
            }
     }

     public function postBlog(Request $request){
            

        $this->validate($request, [
            'poster_id' => 'required',
            'title' => 'required',
            'poster' => 'required',
            'content' => 'required',
            'blog-img' => 'image|nullable|max:1999',
            
        ]);
        //handle file upload
        if($request->hasFile('blog-img')){
        //get filename with the extension
        $fileNameWithExt = $request->file('blog-img')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('blog-img')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('blog-img')->storeAs('public/img/blog', $fileNameToStore);

        }else{
        $fileNameToStore = "";
        }
   
        
         $blog = new Blog;
         $blog->user_id = $request->input('poster_id');
         $blog->title = $request->input('title');
         $blog->poster_name = $request->input('poster');
         $blog->cnt = $request->input('content');
         $blog->blog_img = $fileNameToStore;
         $blog->save();

         return redirect('/dashboard')->with('success', 'Blog post created');
        
        //$blog = Blog::create($input);
        //$success['token'] =  $user->createToken('MyApp')->accessToken;
        //$success['blog_id'] =  $blog->id;
        //$success['title'] =  $blog->title;
        //$success['poster'] =  $blog->poster_name;
        //$success['content'] =  $blog->cnt;
        //$success['file'] =  $blog->blog_img;
        //Storage::makeDirectory('storage/'.$user->email , 0775);

        //Storage::makeDirectory('/app/users/'.$user->id.'/store', 0775);
        //Storage::makeDirectory('/app/users/'.$user->id.'/profile' , 0775);
        
        
     }

     public function postService(Request $request){
        $this->validate($request, [
            'service-name' => 'required',
            'user' => 'required',
            'content' => 'required',
            'serv-img' => 'image|nullable|max:1999',
            
        ]);

        //handle file upload
        if($request->hasFile('serv-img')){
            //get filename with the extension
            $fileNameWithExt = $request->file('serv-img')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('serv-img')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('serv-img')->storeAs('public/img/services', $fileNameToStore);
    
            }else{
            $fileNameToStore = "";
            }
   
        
         $service = new Service;
         $service->name = $request->input('service-name');
         $service->user = $request->input('user');
         $service->content = $request->input('content');
         $service->tag = $fileNameToStore;
         $service->save();

         return redirect('/dashboard/services')->with('success', $service->name.'service succesfully created.');
     }

     public function updateService(Request $request){
        $this->validate($request, [
            'service-name' => 'required',
            'service-id' => 'required',
            'content' => 'required',
            'serv-img' => 'image|nullable|max:1999',
            
        ]);

        //handle file upload
        if($request->hasFile('serv-img')){
            //get filename with the extension
            $fileNameWithExt = $request->file('serv-img')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('serv-img')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('serv-img')->storeAs('public/img/services', $fileNameToStore);
    
            }else{
            $fileNameToStore = "";
            }
   
        
         $service = Service::find($request->input('service-id'));
         $service->name = $request->input('service-name');
         $service->user = Auth::user()->email;
         $service->content = $request->input('content');
         if($fileNameToStore != ""){
         $service->tag = $fileNameToStore;
         }
         $service->save();

         return redirect('/dashboard/services')->with('success', $service->name.'service succesfully updated.');
     }

     public function deleteService( $id ){
        $service = Service::find($id);
        $service->delete(); 
        return redirect('/dashboard/services')->with('success', 'service deleted.');
     }

     public function postSubService(Request $request){
        $this->validate($request, [
            'service-name' => 'required',
            'service-id' => 'required',
            'service-link' => 'nullable',
            
        ]);

        $subServices = new SubService;
        $subServices->ser_id = $request->input('service-id');
        $subServices->name = $request->input('service-name');
        $subServices->url = $request->input('service-link');
        $subServices->save();
        return redirect('/dashboard/services/'.$subServices->ser_id)->with('success', $subServices->name.'succesfully created.');
     }

     public function deleteSubService( $id ){
         
        $subServices = SubService::find($id);
        $subServices->delete();
        return redirect('/dashboard/services')->with('success', 'SubService succesfully deleted.');
     }

     public function postServiceRequest(Request $request){

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'service' => 'required',
            'subService' => 'required',
            'note' => 'nullable',
            
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $serviceRequest = ServiceRequest::create($input);
        return $this->sendResponse($serviceRequest, 'Service request sent succesfully.');

     }

     public function createUser(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'profession' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            
        ]);
   
        
         $user = new User;
         $user->name = $request->input('name');
         $user->email = $request->input('email');
         $user->password = bcrypt($request->input('password'));
         $user->profession = $request->input('profession');
         $user->admin = Auth::user()->id;
         $user->save();
         Storage::makeDirectory('/app/public/img/users/'.$user->email, 0775);

         return redirect('/dashboard/users')->with('success', $user->name.' account succesfully created.');
     }

     public function deleteUser( $id ){
         $user = User::find($id);
         $user->delete();
         return redirect('/dashboard/users')->with('success', ' account deleted succesfully.');
     }


     public function updateContent(Request $request, $name){
                    
        $this->validate($request, [
            'cnt-name' => 'required',
            'content' => 'required',
            
        ]);

         $content = Content::find($request->input('cnt-name'));
         $content->value = $request->input('content');
         
         $user->save();

         return redirect('/dashboard/content')->with('success', $content->name.' updated succesfully.');
     }

     public function SendNewsLetter(Request $request){
        $this->validate($request, [
            'poster' => 'required',
            'sender' => 'required',
            'title' => 'required',
            'content' => 'required',
            'news-email' => 'required',
            
        ]);
        
        return $request->input('news-email');

     }

     public function updateInfo(Request $request){
        $this->validate($request, [
            'phone' => 'nullable',
            'mobile' => 'nullable',
            'email' => 'required',
            'address' => 'required',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'logo' => 'image|nullable|max:1999',
            'icon' => 'image|nullable|max:1999',
            'client' => 'nullable',
            'project' => 'nullable',
            'award' => 'nullable',
            'counrtries' => 'nullable',
            ]);

            if($request->hasFile('logo')){
                //get filename with the extension
                $fileNameWithExt = $request->file('logo')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $request->file('logo')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('logo')->storeAs('public/img/logo', $fileNameToStore);
        
                }else{
                $fileNameToStore = "";
                }

                if($request->hasFile('icon')){
                    //get filename with the extension
                    $fileNameWithExt2 = $request->file('icon')->getClientOriginalName();
                    //get just filename
                    $filename2 = pathinfo($fileNameWithExt2, PATHINFO_FILENAME);
                    //get just ext
                    $extension2 = $request->file('icon')->getClientOriginalExtension();
                    //filename to store
                    $fileNameToStore2 = $filename2.'_'.time().'.'.$extension2;
                    $path2 = $request->file('icon')->storeAs('public/img/icon', $fileNameToStore2);
            
                    }else{
                    $fileNameToStore2 = "";
                    }
        
                    $info = Info::find(1);
                    $info->phone = $request->input('phone');
                    $info->mobile = $request->input('mobile');
                    $info->email = $request->input('email');
                    $info->address = $request->input('address');
                    $info->facebook = $request->input('facebook');
                    $info->twitter = $request->input('twitter');
                    $info->linkedin = $request->input('linkedin');
                    $info->instagram = $request->input('instagram');
                    $info->youtube = $request->input('youtube');
                    $info->client_capacity = $request->input('client');
                    $info->project_done = $request->input('project');
                    $info->awards = $request->input('award');
                    $info->countries_reached = $request->input('countries');
                    if($fileNameToStore != ""){//check if file field is not empty
                    $info->logo = $fileNameToStore;  
                    }
                    if($fileNameToStore2 != ""){//check if file field is not empty
                    $info->icon = $fileNameToStore2;
                    }
                    $info->save();

                    return redirect('/dashboard/site_info')->with('success', 'Fields updated succesfully.');

     }


     public function updateProfile(Request $request){
        $this->validate($request, [
            'profession' => 'nullable',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'instagram' => 'nullable',
            'photo' => 'image|nullable|max:1999',
            ]);

            if($request->hasFile('photo')){
                //get filename with the extension
                $fileNameWithExt = $request->file('photo')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $request->file('photo')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('photo')->storeAs('public/img/users/'.Auth::user()->email, $fileNameToStore);
        
                }else{
                $fileNameToStore = "";
                }

                    $user = User::find(Auth::user()->id);
                    $user->profession = $request->input('profession');
                    $user->facebook = $request->input('facebook');
                    $user->twitter = $request->input('twitter');
                    $user->linkedin = $request->input('linkedin');
                    $user->instagram = $request->input('instagram');
                    
                    if($fileNameToStore != ""){//check if file field is not empty
                        $user->img = $fileNameToStore;  
                    }
                    
                    $user->save();

                    return redirect('/dashboard/profile/'.Auth::user()->id)->with('success', 'Your profile has been updated succesfully.');

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
