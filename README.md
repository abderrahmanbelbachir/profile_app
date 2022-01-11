## Project setup

******** URL to the deployed app *******
- the application is deployed on google cloud run service instance
- the automoatic build and deploy is set on each push on the master branch
- a cloud sql instance created and linked with the cloud run service to manage the database

```
https://profile-app-t3lcl2l7ba-uc.a.run.app
```

To setup the project follow these steps :

- Clone the repository

```
git clone https://github.com/abderrahmanbelbachir/profile_app.git
```

- Open the terminal and point to the cloned project ( profile_app )

```
cd profile_app

```


- If you are using windows command line run the init project shell file (which will run all the necessary commands) like this : 

```
init_project.sh
```

- If you are using git bash command line run the init project shell file (which will run all the necessary commands) like this : 

```
./init_project.sh

```

- If you are not using laradock or homestead : 

```
php artisan serve .

```

- Open your browser and navigate to : 

```
http://localhost/

```

Or navigate to : 

```
http://localhost:8000
```

1 - What was your approach to this project

```
I started with Hierarchical Model View Controller approach but it changed to a simple MVC because there is not a lot of entities ( we have on ly user entity )
```

2 - What were the challenges you faced?

```
* At the hosting stage : 
 - I faced some version probleme ( when compiling with docker ) which forced me to change the docker configuration
 - I faced a strange bug ( all routes being used as non secure routes ) 
 
```

3 - How differently will you do if you had a couple of more days to complete the assignment

```
* I would add more tests .
* I would use only api routes to process updates 
* I would split the update of profile to steps ( update experiences / update organizations / update personal informations )

```

4 - What if you have one full month?

```
* The changes mentioned in the couple of more days section
* I would use TDD approche 
* I would build the frontend as a separated project using angular and the keep only the apis on the laravel part

```