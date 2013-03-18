Clone the GIT directory
----------------------------------------------------------
git clone https://github.com/vineeshc/dropnshare.git

Give the permissions to the following folders
---------------------------------------------------------
chmod 777 runtime/ -Rf (This folder will be inside dropnashare/protected)
chmod 777 assets/ -Rf (This folder will be inside dropnashare/)

Create your DB and change your dropnshare configuration file.
-----------------------------------------------------------------------
create database dropnshare;
Restore the sql file given in dropnshare.sql