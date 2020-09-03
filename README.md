    >>>>>>>>Employee_system_management_datatabled
    
    
    1-first start
    on the directore 
    run  composer install 
    to install all packages
    then
    set .env file database then 
    run <>  php artisan migrate --seed <>
    to migrate data base 
    then 
     run <>  npm install  then --> npm run dev <> 
     the server expected run on host localhost:8000 
     go to the browser and hit root bath and login with 
     username : superuser 
     password: superuser 
     which migrated with seeder 
     for super user 
     
     will redirect you to home page wich show you 3 buttons 
     first:
     used bundle in laravel datatable and there all crud operation 
     ------assumption that the logged in user has appility to contor only on his employye
     whed pushing create employee tha modal showed and has many inputs validated and has also picker map from googlemap api that allow you to pick location of user 
     
     and this also for editing 
     the datatable provide search with all fields with pagination 
     
     the second button in home bage ::
     show all users in server and super user has ability to change role of user to be admin or not 
     
     the third page ::
     for super user also and showed all employee with apility to delete 
     and with search with name 
     with paginating also 
     
     ======================
     the server provide two api 
     first : 
     for searching employee with custom search with name or with status or both with pagination 
     uri :http://localhost:8000/api/search
     example:{
"status":"Not_active",
"name":"Hazem"
=========== like this=======

}
     retreived opject ::{
    "status": true,
    "errNum": "S000",
    "msg": "search done ",
    "search_employee": {
        "current_page": 1,
        "data": [
            {
                "id": 2,
                "f_name": "ahmed",
                "l_name": "Hazem",
                "job": "eng",
                "status": "active",
                "location_lng": "30.031872",
                "location_lat": "30.031872",
                "image": "images/5f4fdea791a5b.jpg",
                "user_id": 1,
                "created_at": "2020-09-02 18:04:23",
                "updated_at": "2020-09-02 18:04:23"
            }
        ],
        "first_page_url": "http://localhost:8000/api/search?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://localhost:8000/api/search?page=1",
        "next_page_url": null,
        "path": "http://localhost:8000/api/search",
        "per_page": 3,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
}

=========== like this=======
    
    second api
    for get employee info
    
    
    http://localhost:8000/api/employee/2
    =========== samble=======
    

    {
    "status": true,
    "errNum": "S000",
    "msg": "employee data get successfully",
    "employee": {
        "id": 2,
        "f_name": "ahmed",
        "l_name": "Hazem",
        "job": "مهندس",
        "status": "active",
        "location_lng": "30.031872",
        "location_lat": "30.031872",
        "image": "images/5f4fdea791a5b.jpg",
        "user_id": 1,
        "created_at": "2020-09-02T18:04:23.000000Z",
        "updated_at": "2020-09-02T18:04:23.000000Z"
    }
}
   
  =========== Thank You =======


        
