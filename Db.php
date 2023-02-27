<?php
include 'connection.php';
	class Db{
	public function user_login($email, $pass)
	{	
		$ob = mysqli_query($GLOBALS['con'], "SELECT * from users where email = '".$email."' ");
			if ($res = $ob->fetch_object()) {
				if ($res->email == $email && $res->password == $pass) {
					mysqli_query($GLOBALS['con'],
						"UPDATE users set active = 1 where uid = '".$res->uid."' ");
					return $_SESSION['user-id'] = $res->uid;
				}
			}	
	}
	public function reg_user($reg_rec)
	{
		$rand_num = rand(100,999);
		$prefix = "id".$rand_num;
		$uid = uniqid($prefix, ture);
		$query = "INSERT into users (firstname, lastname, uid,email,password,gender,dob,status) values ('".$reg_rec['fname']."', '".$reg_rec['lname']."', '".$uid."', '".$reg_rec['email']."', '".$reg_rec['pass']."', '".$reg_rec['gender']."', '".$reg_rec['dob']."', '".$reg_rec['status']."') ";
		$make_folder = mkdir($uid);
		if ($make_folder) {
			copy('images/avtar.jpg', $uid.'/avtar.jpg');
		}
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function user_rec($id)
	{
		$query = mysqli_query($GLOBALS['con'],"select * from users where uid= '".$id."' ");
		return $query;
	}
	public function upload_img($img_name,$img_tmp, $uid)
	{
		$uploaded = move_uploaded_file($img_tmp, $uid."/".$img_name);
		$query = "UPDATE users set profile_img = '".$img_name."' where uid ='".$uid."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function logout()
	{		
		session_start();
			mysqli_query($GLOBALS['con'],"UPDATE users set active = 0 where uid = '".$_SESSION['user-id']."' ");
		session_destroy();
	}

	public function rec_4_update($uid)
	{
		$query = mysqli_query($GLOBALS['con'],"select * from users where uid= '".$uid."' ");
		return $query;
	}
	public function update_user_rec($user_rec_4_update)
	{
		$query = "UPDATE users set 
		firstname = '".$user_rec_4_update['fname']."', 
		lastname = '".$user_rec_4_update['lname']."',  
		father_name = '".$user_rec_4_update['fathername']."', 
		dob = '".$user_rec_4_update['dob']."', 
		phone_num = '".$user_rec_4_update['phone']."', 
		martial_status = '".$user_rec_4_update['martial_status']."', 
		nationality = '".$user_rec_4_update['nationality']."', 
		religion = '".$user_rec_4_update['religion']."', 
		cnic = '".$user_rec_4_update['cnic']."', 
		country = '".$user_rec_4_update['country']."', 
		city = '".$user_rec_4_update['city']."', 
		area = '".$user_rec_4_update['area']."', 
		language = '".$user_rec_4_update['language']."', 
		qualification = '".$user_rec_4_update['qualification']."', 
		skills = '".$user_rec_4_update['skills']."', 
		experience = '".$user_rec_4_update['experience']."', 
		expected_salary = '".$user_rec_4_update['salary']."', 
		about = '".$user_rec_4_update['about']."', 
		company = '".$user_rec_4_update['company']."'
		where  uid = '".$user_rec_4_update['uid']."' 
		";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function province()
	{
		$query = "select * from province";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function city($province)
	{
		$query ="select * from cities where province = '".$province."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function post_job($job_rec)
	{
		$query = "INSERT into jobs 
		(pid,title,type,category,salary,country,province,city,descrimination,company,employername,employer_pic,date_time)
		VALUES ('".$job_rec['pid']."', '".$job_rec['title']."', '".$job_rec['type']."', '".$job_rec['category']."', '".$job_rec['salary']."', '".$job_rec['country']."', '".$job_rec['province']."', '".$job_rec['city']."', '".$job_rec['decription']."', '".$job_rec['company']."', '".$job_rec['empoyername']."', '".$job_rec['empic']."', '".$job_rec['date']."')";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function all_jobs()
	{
		$query = "SELECT * FROM jobs";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function user_posted_jobs($pid)
	{
		$query = "SELECT * FROM jobs where pid = '".$pid."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function edit_job($id)
	{
		$query = "SELECT * from jobs where id = '".$id."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function update_job($job_update_rec)
	{
		$query = "UPDATE jobs set 
		title = '".$job_update_rec['title']."',
		type = '".$job_update_rec['type']."',
		salary = '".$job_update_rec['salary']."',
		company = '".$job_update_rec['company']."',
		province = '".$job_update_rec['province']."',
		city = '".$job_update_rec['city']."',
		 descrimination = '".$job_update_rec['description']."' WHERE id= '".$job_update_rec['ujid']."' ";
		 return mysqli_query($GLOBALS['con'],$query);
	}
	public function delete_job($job_id)
	{
		$query = "DELETE FROM jobs where id = '".$job_id."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function search_job($search_rec)
	{
		$query = "SELECT * FROM jobs where 
		title = '".$search_rec['title']."' OR category = '".$search_rec['title']."' AND province = '".$search_rec['province']."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function search_job_with_city($search_rec)
	{
		$query = "SELECT * FROM jobs where 
		title = '".$search_rec['title']."' OR category = '".$search_rec['title']."' AND city = '".$search_rec['city']."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function admin_login($email, $pass)
	{
		$query = "select * from admin where email = '".$email."' AND pass = '".$pass."' ";
		return mysqli_query($GLOBALS['con'], $query);
	}
	public function users()
	{
		$query = "Select * from users";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function active_user()
	{
		$query = "SELECT * FROM users where active = '1' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function apply_4_job($apply_rec)
	{
		$query = "INSERT into job_applications(job_name,applicant_name,applicant_email,applicant_phone,employer_id,applicant_id)VALUES('".$apply_rec['apjob']."','".$apply_rec['apname']."','".$apply_rec['apemail']."','".$apply_rec['apphone']."','".$apply_rec['em_id']."','".$apply_rec['apuid']."')";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function applications($id)
	{
		$query = "SELECT * FROM job_applications where employer_id = '".$id."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function delete_application($id)
	{
		$query = "DELETE from job_applications where id = '".$id."' ";
		mysqli_query($GLOBALS['con'],$query);
	}
	public function change_password($id,$new_pass)
	{
		$query = "UPDATE users set password = '".$new_pass."' WHERE uid = '".$id."'  ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function change_email($id,$new_email)
	{
		$query = "UPDATE users set email = '".$new_email."' WHERE uid = '".$id."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function categories()
	{
		$query = "SELECT * FROM categories";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function add_category($value)
	{
		$query = "INSERT INTO categories(category)VALUES('".$value."')";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function delete_category($id)
	{
		$query = "DELETE FROM categories where id = '".$id."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function admin_rec($id)
	{
		$query = "SELECT * FROM admin where id = '".$id."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function change_ad_username($name,$id)
	{
		$query = "UPDATE admin set email = '".$name."' where id = '".$id."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
	public function change_ad_pass($new_pass,$id)
	{
		$query = "UPDATE admin set pass = '".$new_pass."' where id = '".$id."' ";
		return mysqli_query($GLOBALS['con'],$query);
	}
}	
?>