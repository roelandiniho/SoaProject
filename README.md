# SoaProject

This is a project for: SOA and cloud computing for FIIWW Uhasselt

create mysql db on port 3306: name=quotes, username=root, password=root

in webapp project: to create db tables
  php artisan migrate
To fill db with some test data
  php artisan db:seed
To start the webapp on http://localhost:8000
  php artisan serve

go to http://localhost:8000 in browser. Webapp should open with login/register at top right
Register a user, login with this user. This is the authentication of the webapp


Go to http://localhost:8000/quotes. This is a REST call to the DB which is filled with quotes. 
Id, Title and Body are filled randomly with testdata

Go to http://localhost:8000/quotes/1 to get first quote. other numbers work aswell

