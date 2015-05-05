## LastBugs Bugtracker

This bug tracking system not better than others. Maybe even worse. But I try to do it much easier to use not only for developers, but for users far from programming.

This bug tracker is based on Laravel 4 and for now has 2 languages: English and Russian.

### Installation

There are no installer, but you only have to use Laravel migrations to install bug tracker. Use your favorite web-server such as Apache or Nginx. You have to point it to public folder.

After that, in terminal you have to type:

    php artisan migrate
    
If you use production environment, it will ask you to confirm. Press **y**.

Artisan will create necessary tables in database. After that, you tracker installed successfully.

### Usage

After that, register and create your first project, where you can add issues.

There are no superadmin in this system. Every user has it's own sandbox with projects and issues and can add other users from contacts list to it's sandbox, f.e. it's team members.

To contacts list users can be added by email address.

Every team member has access permissions. There are 3 roles:

- Teamlead
- Developer
- Observer

Permission information can be explored in user management screen of project.

----

BBug can estimate budget of the project, percent of completion, effectiveness and overload of every team member in project.

You can find this information in  project info tab.

### Contribution

Every help in development would make me happy.