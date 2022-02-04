<?php

    use App\Permission;
    use App\Role;

    use App\User;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        Model::unguard();
        DB::table('users')->delete();
        //DB::table('roles')->delete();
        DB::table('permissions')->delete();
        $county= ["name"=>"Nairobi"];
        $sub_county= ['county_id'=>1,"name"=>"Nairobi"];
        $user=['referral_code'=>"FEP001",'firstname'=>"James", 'middlename'=>"Kinyua", 'surname'=>'Mwangi','phone'=>"254722705138", 'email'=>"","doc_no"=>'30127587','password'=>bcrypt('pass@1234'),'status'=>1,'sub_county_id'=>1];
        $roles= ["name"=>"admin", "display_name"=>"Admin","description"=>"Admin- he/she can do limited admin capabilities"];
        $permissions=["name"=>'create-users', "display_name"=>'Create Users',"description"=>'He/she can do add/update/delete system users'];
        $county=User::create($county);
        $sub_county=User::create($sub_county);
        $user=User::create($user);
        $role= Role::create($roles);
        $permission=Permission::create($permissions);
        $user->roles()->attach($role->id);
        $role->attachPermission($permission);

    \Illuminate\Database\Eloquent\Model::reguard();
    // $this->call(UsersTableSeeder::class);
    }
}
