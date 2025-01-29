<?php

    class UsersController {
        static function default() {
            require_once '../app/models/Session.php';
            Session::start();
        
            require_once '../app/models/User.php';
            require_once '../app/models/Hotel.php';
            require_once '../app/models/Perms.php';
        
            $title = "Gestion | Utilisateurs";
            $selected = "users";
            
            require_once '../app/controllers/base_init.php';
        
            if(!User::isAdmin($userId)) {
                header('Location: choice.php');
                exit();
            }
        
            // Delete user
            if(isset($_GET['action']) && $_GET['action']=="delete") {
                if(isset($_GET['user_id']) && !empty($_GET['user_id']) && !User::isAdmin($_GET['user_id'])) {
                    User::deleteUser($_GET['user_id']);
                }
            }
        
            // Perms
            $hotels = Perms::getFilteredPermissionsByUser($userId);
            if(!isset($hotels[$hotelId])) {
                header('Location: choice.php');
                exit();
            }  
        
            // Search part
            if(isset($_GET['search']) && !empty($_GET['search']))
                $userSearch = User::searchUser($_GET['search']);
            
            // Table part
            $tablePage = $_GET['page'] ?? 1;
            $tableStep = USER_LIST_STEP;
        
            $users = User::getUsers(($tablePage == 1 ? 1 : $tablePage*$tableStep-$tableStep), $tablePage*$tableStep);
            $prevPage = $tablePage==1 ? 1 : $tablePage-1;
            $nextPage = $tablePage+1;
            
            require '../app/views/dashboard_top.php';
            require '../app/views/users/users.php';
        }
    }

?>