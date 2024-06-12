<?php
include('database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$msg = "";
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $comment = mysqli_real_escape_string($con, $_POST['comment']);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $uploadOk = 1;

    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($image)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ){
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
   


    $query = "insert into contact(name,email,mobile,comment,image) values('$name','$email','$mobile','$comment','$target_file')";
    $query_run = mysqli_query($con, $query);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="a.css">
    <title>iEducate-Transforming online education</title>
</head>

<body>
    <nav class="navbar background">
        <ul class="nav-list">
            <div class="logo"><img src="img.png" alt="logo"></div>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Service</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
        <div class="rightNav">
            <input type="text" name="search" id="search" placeholder="Type here">
            <button class="btn btn-sm">Search</button>
        </div>
    </nav>
    <section class="background firstSection">
        <div class="box-main">
            <div class="firstHalf">
                <p class="text-big">The Future of Education is here</p>
                <p class="text-small">In this world of 7 billion people we need to educate all of them.This is the
                    future of the educated world and we are proud to say that the future of education is here
                </p>
                <div class="buttons">
                    <button class="btn">Subscribe</button>
                    <button class="btn">Watch Video</button>
                </div>
            </div>

            <div class="secondHalf">
                <img src="img.png" alt="laptop image">
            </div>
        </div>
    </section>

    <section class="section">
        <div class="paras">
            <p class="sectionTag text-big">The end of your search is here</p>


            <p class="sectionsubTag text-small"><i>Education is the transmission of knowledge, skills, and character
                    traits. There are many debates about its precise definition, for example, about which aims it tries
                    to achieve. A further issue is whether part of the meaning of education is that the change in the
                    student is an improvement. Some researchers stress the role of critical thinking to distinguish
                    education from indoctrination. These disagreements affect how to identify, measure, and improve
                    forms of education. The term can also refer to the mental states and qualities of educated people.
                    Additionally, it can mean the academic field studying education.The definition of education has been
                    explored by theorists from various fields.Many agree that education is a purposeful activity aimed
                    at achieving certain goals, which include the transmission of knowledge, skills, and character
                    traits.However, there is extensive debate regarding its exact nature beyond these general features.
                    Some theorists view education primarily as a process that occurs during educational events such as
                    schooling, teaching, and learning.Others perceive it not as a process but as the product resulting
                    from this process, emphasizing the mental states and dispositions of educated persons.</i></p>
        </div>
        <div class="thumbnail">
            <img src="https://source.unsplash.com/900x900/?coding,apple" alt="image laptop" class="imgFluid">
        </div>

    </section>

    <section class="sectionleft">
        <div class="paras">
            <p class="sectionTag text-big"><u>Transforming Education in India</u></p>
            <p class="sectionsubTag text-small"><i>Education socializes children into society by teaching cultural
                    values and norms. It equips them with the skills needed to become productive members of society.
                    This way, it stimulates economic growth and raises awareness of local and global problems. Organized
                    institutions affect many aspects of education. For example, governments set education policies. They
                    determine when school classes happen, what is taught, and who can or must attend. International
                    organizations, like UNESCO, have been influential in promoting primary education for all children.

                    Many factors influence whether education is successful. Psychological factors include motivation,
                    intelligence, and personality. Social factors, like socioeconomic status, ethnicity, and gender, are
                    often linked to discrimination. Further factors include educational technology, teacher quality, and
                    parent involvement.</i></p>
        </div>
        <div class="thumbnail">
            <img src="https://source.unsplash.com/900x900/?coding,pen" alt="image laptop" class="imgFluid">
        </div>

    </section>

    <section class="section">
        <div class="paras">
            <p class="sectionTag text-big">Let's grow Together</p>
            <p class="sectionsubTag text-small"><i>The main field investigating education is called education studies.
                    It examines what education is and what aims it has. It also studies how it happens, what effects it
                    has, and how to improve it. It has many subfields, like philosophy of education, psychology of
                    education, sociology of education, economics of education, and comparative education. It also
                    discusses the history of education. In prehistory, education happened informally through oral
                    communication and imitation. With the rise of ancient civilizations, writing was invented, and the
                    amount of knowledge grew. This caused a shift from informal to formal education. Initially, formal
                    education was mainly available to elites and religious groups. The invention of the printing press
                    in the 15th century made books more widely available. This increased general literacy. Beginning in
                    the 18th and 19th centuries, public education became more important. It led to the worldwide process
                    of making primary education available to all, free of charge, and compulsory up to a certain
                    age.</i>
            </p>
        </div>
        <div class="thumbnail">
            <img src="https://source.unsplash.com/900x900/?laptop,coding" alt="image laptop" class="imgFluid">
        </div>

    </section>

    <section class="contact">
        <h1 class="text-center">Contact Us</h1>
        <form class="form" enctype="multipart/form-data" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name">
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="mobile" name="mobile" id="mobile" placeholder="Enter your mobile">
            <textarea name="comment" id="" cols="30" rows="10" placeholder="Elaborate your comment"></textarea>
            <input type="file" name="image" id="image1" placeholder="Enter your mobile">
            <button type="submit" class="batn" name="submit" id="submit">Submit</button>
        </form>
    </section>

    <footer>
        <p class="text-footer background">
            Copyright &copy; 2023 iEducate.com - All rights reserved
        </p>
    </footer>
</body>

</html>