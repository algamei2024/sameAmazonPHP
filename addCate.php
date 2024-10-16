<?php
require("connect.php"); 
if(isset($_GET["cate"]))
{
    $name_cat = $_GET["cate"];
    $id_cat = $_GET["id_cat"];
  $sql = "INSERT into category values($id_cat,'$name_cat')";
  if($con->query($sql) == TRUE)
  {
    echo "تم إضافة الفئة بنجاح";
  }
  else
  {
    echo "حدث خطا اثناء إضافة الفئة";
  }
}
if(isset($_FILES["file"]))
{
var_dump($_FILES["file"]);
$dir = "images/";
  $filename = basename($_FILES["file"]["name"]);
  $filename = $dir.$filename;
  $ok = 1;
  $typeImg = explode("." , $filename);
  $typeImg = $typeImg[count($typeImg) - 1];
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if(!($check !== false))
  {
    $ok = 0;
  }
  if(file_exists($filename))
  {
    $ok = 0;
  }
  if($_FILES["file"]["size"] > 800000)
  {
    $ok = 0;
  }
  if($typeImg != "jpg" && $typeImg != "png" && $typeImg != "jpeg" && $typeImg != "gif")
  {
    $ok = 0;
  }
  if($ok == 1)
  {
    if(move_uploaded_file($_FILES["file"]["tmp_name"] , $filename))
    {
      echo "تم تحميل الصورة بنجاح";
      $name = $_POST["name"];
      $cat = $_POST["cat"];
      $desc = $_POST["desc"];
      $pric = $_POST["price"];
       $dat = date("Y-m-d");
      $sql = "INSERT into prudocts(name_prud,desc_prud,price_prud,sourc_img,date_prud,id_cat) values('{$name}' , '{$desc}' , {$pric} , '{$filename}','{$dat}', $cat)";
      if($con->query($sql) === TRUE)
      {
        echo "تم إضافة المنتج بنجاح";
      }
      $con->close();
    }
    else{
      echo "فشل تحميل الصورة";
    }
  }
  else{
     echo " لا بمكن تحميل الصور للاسباب : 1. كبر حجمها 2.عدم توافق نوعها بالمطلوب 3. حملت ملف ليس صورة 4.قد تكون موجوده مسبقاً";
  }
}
 if(isset($_GET['value']))//هنا إرجاع رابط الصورة ومعلومات المنتج عند الضغط علية في لوحة التحكم
  {
    $val = $_GET["value"];
    $sql = "select * from prudocts where id_prud = ". $val;
    $rows = $con->query($sql);
    if($rows->num_rows== 1 )
    {
      $row = $rows->fetch_assoc();
      echo $row["sourc_img"] ."#$";
      echo $row["price_prud"] ."#$";
      echo $row["desc_prud"];
    }

  }
if(isset($_GET["delete"]))
{
  $val = $_GET["id"];
  $sql = "select sourc_img from prudocts where id_prud = $val";
  $rows = $con->query($sql);
  $row = $rows->fetch_assoc();
  $sours_img = $row["sourc_img"];
  $sql = "DELETE from prudocts where id_prud = $val";
  if($con->query($sql) === TRUE)
  {
    if(file_exists($sours_img))
    {
      if(unlink($sours_img))
      {
        echo "تم حذف الصورة بنجاح";
      }
    }
    echo "تم الحذف بنجاح";
  }
}
if(isset($_POST["name_cate"]))
{
  $newdir = $_POST["oldimg"];
  //--------------هنا رفع الصورة الجديدة اذا وجدت وحذف القديمة
    if(isset($_FILES["fileupdate"]))
    {
      $sours_img = $newdir;
    var_dump($_FILES["fileupdate"]);
    if(file_exists($sours_img))
        {
          if(unlink($sours_img))
          {
            echo "تم حذف الصورة بنجاح";
          }
        }
    $dir = "images/";
      $filename = basename($_FILES["fileupdate"]["name"]);
      $filename = $dir.$filename;
      $newdir = $dir;
      $ok = 1;
      $typeImg = explode("." , $filename);
      $typeImg = $typeImg[count($typeImg) - 1];
      $check = getimagesize($_FILES["fileupdate"]["tmp_name"]);
      if(!($check !== false))
      {
        $ok = 0;
      }
      if(file_exists($filename))
      {
        $ok = 0;
      }
      if($_FILES["fileupdate"]["size"] > 50000)
      {
        $ok = 0;
      }
      if($typeImg != "jpg" && $typeImg != "png" && $typeImg != "jpeg" && $typeImg != "gif")
      {
        $ok = 0;
      }
      if($ok == 1)
      {
        if(move_uploaded_file($_FILES["fileupdate"]["tmp_name"] , $filename))
        {
        }
        else{
          echo "فشل تحميل الصورة";
        }
      }
      else{
        echo " لا بمكن تحميل الصور للاسباب : 1. كبر حجمها 2.عدم توافق نوعها بالمطلوب 3. حملت ملف ليس صورة 4.قد تكون موجوده مسبقاً";
      }
    }
    //-------هنا رفع البيانات الي السيرفر
          $id = $_POST["id"];
          $name = $_POST["name_cate"];
          $cat = $_POST["cat"];
          $desc = $_POST["desc"];
          $pric = $_POST["price"];
          $dat = date("Y-m-d");
          $sql = "UPDATE prudocts set name_prud = '{$name}',desc_prud = '{$desc}',price_prud = {$pric},sourc_img = '{$newdir}',date_prud = '{$dat}',id_cat =  $cat where id_prud = $id";
          if($con->query($sql) === TRUE)
          {
            echo "تم إضافة المنتج بنجاح";
          }
          $con->close();
}
//-----------إضافة المنتج الي السلة
if(isset($_GET["object"]))
{
 $object = json_decode($_GET["object"]);
 if(sizeof((array)$object) == 3)
 {
    $sql = "SELECT quantity_order from purchases where id_cust = $object->id_cust and id_prud = $object->id_prud";
    $rows = $con->query($sql);
    $row = $rows->fetch_assoc();
    $quantity = $row["quantity_order"] + $object->quantity;
     $sql = "UPDATE purchases set quantity_order =  $quantity where id_cust = $object->id_cust and id_prud = $object->id_prud";
    if($con->query($sql) == TRUE)
    {
      echo "تم تحديث الكمية";
    }
 }
 else
 {
 $sql = "INSERT into purchases values($object->id_cust , $object->id_prud , $object->quantity , '$object->order_status' , $object->check)";
 if($con->query($sql) == TRUE)
 {
  echo "تم الاضافة بنجاح";
 }
 else
 {
  echo "حدث خطا اثناء الاضافة";
 }
}
}
 //--- حذف الزبون
  if(isset($_GET["id_cust"]))
  {
    $id_cust = $_GET["id_cust"];
    $sql = "DELETE from customars where id = $id_cust";
    if($con->query($sql) === TRUE)
    {
      echo "<script>alert('تم الحذف بنجاح')</script>";
      header("Location:control.php");
      exit;
    }
  }
if(isset($_GET["box_del_prud_id"]))
{
  $object = json_decode($_GET['box_del_prud_id']);
  $sql = "DELETE from purchases where id_prud = $object->id_prud and id_cust = $object->id_cust";
  if($con->query($sql) == TRUE)
  {
    echo "تم بنجاح";
  }
}
?>