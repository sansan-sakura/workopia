<?php

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;
use Framework\Session;
use Framework\Authorization;

class ListingsController
{

    protected $db;
    public function __construct()
    {       
        $config= require basePath('config/db.php');
        $this->db= new Database($config);
    }


    public function index()
    {
      $listings=$this->db->query('SELECT * FROM listings ORDER BY created_at LIMIT 6')->fetchAll();
      loadView('listings/index',[
      'listings'=>$listings ]);
    }

    public function create(){
       loadView("listings/create");
    }

    public function show($params){
     $id=$params['id']??"";
     $params=[
    'id'=>$id ];
     $listing=$this->db->query('SELECT * FROM listings WHERE id= :id', $params)->fetch();

     if(!$listing){
        ErrorController::notFound('Listing not found');
     }


     loadView('listings/show',[
    'listing'=>$listing]);

    }

    public function store(){

        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];

        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));
    
        $newListingData['user_id'] = Session::get('user')['id'];
    
        $newListingData = array_map('sanitize', $newListingData);
    
        $requiredFields = ['title', 'description', 'salary', 'email', 'city', 'state'];
    

         $errors=[];

         foreach($requiredFields as $field){
            if(empty($newListingData[$field])||!Validation::string($newListingData[$field]))
            {
                $errors[$field]=ucfirst($field). ' is required';
            
            }}
               if(!empty($errors)){
               loadView("listings/create",['errors'=>$errors,'listing'=>$newListingData]);
                 } else {


                $fields=[];

                foreach($newListingData as $field =>$value){
                    $fields[]=$field;
                }
               $fields=implode(',',$fields);

               $value=[];

               foreach($newListingData as $field =>$value){

                if($value===""){
                    $newListingData[$field]=null;
                }

                $values[]=':'.$field;
               }

               $values=implode(', ',$values);

               $query="INSERT INTO listings ({$fields}) VALUES ({$values})";

               $this->db->query($query, $newListingData);

               Session::getFlashMessage('success_message','listing created successfully');
               redirect('/listings');

         }
    }

    public function destroy($params){
        $id=$params['id'];

        $params=[
            'id'=>$id
        ];

        $listing=$this->db->query('SELECT * FROM listings WHERE id=:id',$params)->fetch();

        if(!$listing){
            ErrorController::notFound("listing not found");
            return;
        }

        if(!Authorization::isOwnere($listing->user_id)){
            Session::getFlashMessage('error_message','You are not authorized to delete this listing');
            redirect('/listings/'.$listing->id);
        }

        $this->db->query('DELETE FROM listings WHERE id=:id',$params);

        Session::getFlashMessage('success_message','listing deleted successfully');

        redirect('/listings');
    }

    public function edit($params){
        $id=$params['id']??"";
        $params=[
       'id'=>$id ];
        $listing=$this->db->query('SELECT * FROM listings WHERE id= :id', $params)->fetch();
   
        if(!$listing){
           ErrorController::notFound('Listing not found');
        }

        if(!Authorization::isOwnere($listing->user_id)){
            Session::getFlashMessage('error_message','You are not authorized to delete this listing');
            redirect('/listings/'.$listing->id);
        }

   
   
        loadView('listings/edit',[
       'listing'=>$listing]);
   
       }


       public function update($params){
        $id=$params['id']??"";
        $params=[
       'id'=>$id ];

        $listing=$this->db->query('SELECT * FROM listings WHERE id= :id', $params)->fetch();
   
        if(!$listing){
           ErrorController::notFound('Listing not found');
        }

        if(!Authorization::isOwnere($listing->user_id)){
            Session::getFlashMessage('error_message','You are not authorized to update this listing');
            redirect('/listings/'.$listing->id);
        }


        $allowedFields=['title','description','salary','tags','company','address','city','state','phone','email','requirements','benefits',"user_id"];
       
        $updatedValues=array_intersect_key($_POST, array_flip($allowedFields));

        $updatedValues=array_map("sanitize",$updatedValues);

        $requiredFields=['title','description','salary','email','city','state'];

        $errors=[];

        foreach($requiredFields as $field){
            if(empty($updatedValues[$field] ||!Validation::string($updatedValues[$field]))){
                $errors[$field]=ucfirst($field).' is required';
            }
        }
   
        if(!empty($errors)){
            loadView('listings/edit',[
                'listing'=>$listing,
                'errors'=>$errors
            ]);
            exit;
        } else {

            $updateFields=[];

            foreach(array_keys($updatedValues) as $field){
                $updateFields[]="{$field}=:{$field}";

            }

            $updateFields=implode(',',$updateFields);
            $updateQuery="UPDATE listings SET $updateFields WHERE id=:id";

            $updatedValues['id']=$id;
            $this->db->query($updateQuery, $updatedValues);

            Session::getFlashMessage('success_message','listing updated successfully');

            redirect('/listings/'.$id);

        }


       }


       public function search(){
        $keywords=isset($_GET['keywords'])?trim($_GET['keywords']):"";
        $location=isset($_GET['location'])?trim($_GET['location']):"";

        $query="SELECT * FROM listings WHERE (title LIKE :keywords OR description LIKE :keywords OR tags LIKE :keyWords OR company LIKE :keywords) AND (city LIKEW :location OR state LIKE :location)";

        $params=[
            'keywords'=>"%{$keywords}%",
            'location'=>"%{$location}}"
        ];

        $listings=$this->db->query($query, $params)->fetchAll();

        loadView('/listings/index',[
            'listings'=>$listings,
            'keywords'=>$keywords,
            'location'=>$location
        ]);
       }
   
}