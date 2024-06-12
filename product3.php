<?php
include_once ('header.php');
if (isset($_POST['save_category'])) {

    $cat_id = mysqli_real_escape_string($conn, $_POST['category']);
    $subcategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $sdescription = mysqli_real_escape_string($conn, $_POST['sdescription']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $addinfo = mysqli_real_escape_string($conn, $_POST['addinfo']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $industry = mysqli_real_escape_string($conn, $_POST['industry']);
    $slug = str_replace(' ', '-', $title);
    $created_at = date("Y-m-d H:s:i");

    $query = "INSERT INTO products(title,sdescription,description,addinfo,slug,cat_id,sub_cat_id,type,brand,industry,created_at) 
              VALUES('$title','$sdescription','$description','$addinfo','$slug','$cat_id','$subcategory','$type',$brand,$industry,'$created_at')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $last_id = mysqli_insert_id($conn);

        foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["files"]["name"][$key];
            $file_tmp = $_FILES["files"]["tmp_name"][$key];
            move_uploaded_file($file_tmp, "uploads/products/" . $file_name);

            $cat_img = "INSERT INTO products_image(p_id,image,created_at) VALUES('$last_id','$file_name','$created_at')";
            $cat_img_run = mysqli_query($conn, $cat_img);
        }

        $_SESSION['success'] = "Products Added Successfully!";
        header("Location: products.php");
    } else {
        $_SESSION['error'] = "Products Not Added Due to Some Error!";
        header("Location: products.php");
    }
}
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 style="font-size:20px;color:#1C2434;margin:40px 0 20px 3px">Add Product</h4>
                    </div>
                    <div class="card">
                        <style>
                            #lmm>input {
                                border-radius: 4px;
                            }

                            #lmm>input::file-selector-button {
                                height: 35px;
                                color: #666666;
                                border: thin solid grey;
                                border-radius: 3px;
                            }
                        </style>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="type" class="form-select form-control" id="type">
                                                <option value="0">---Select----</option>
                                                <option value="1">Packaging Materials</option>
                                                <option value="2">Packaging Solution</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="category_div">
                                            <label>Category</label>
                                            <select id="category" name="category" class="form-select form-control">
                                                <option value="">Select category</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="subcategory_div">
                                            <label>Sub Category</label>
                                            <select id="subcategory" name="subcategory"
                                                class="form-select form-control">
                                                <option value="">Select Subcategory</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Brands</label>
                                            <?php
                                            $query = "SELECT * FROM brand_logo";
                                            $result = mysqli_query($conn, $query);
                                            ?>
                                            <select id="brand" name="brand" class="form-select form-control">
                                                <option value="">Select Brands</option>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['id']; ?>">
                                                            <?php echo $row['logo_name']; ?>
                                                        </option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Industries</label>
                                            <?php
                                            $industry = "SELECT * FROM industry";
                                            $industryresult = mysqli_query($conn, $industry);
                                            ?>
                                            <select id="industry" name="industry" class="form-select form-control">
                                                <option value="">Select Industries</option>
                                                <?php
                                                if (mysqli_num_rows($industryresult) > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($industryresult)) {
                                                        ?>
                                                        <option value="<?php echo $row1['id']; ?>">
                                                            <?php echo $row1['industry']; ?>
                                                        </option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" cols="30" rows="7" class="form-control"
                                                placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="lmm">
                                            <label>Images (465*450)</label><br />
                                            <input class="border" style="width:100%;" type="file" name="files[]"
                                                multiple>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Short Description</label>
                                            <textarea class="form-control" name="sdescription"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" id="description"
                                                name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Additional Information</label>
                                            <textarea class="form-control" id="addinfo" name="addinfo"></textarea>
                                        </div>
                                    </div>
                                    <div class="container mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="tabs">Tabs</label>
                                                    <select id="tabs" name="tabs" class="form-select form-control">
                                                        <option value="">Select Tabs</option>
                                                        <option value="Features">Features</option>
                                                        <option value="Specification">Specification</option>
                                                        <option value="Gallery">Gallery</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button id="addTab" class="btn btn-primary mt-4" type="button">Add
                                                    Tab</button>
                                            </div>
                                        </div>
                                        <div id="textEditorsContainer" class="mt-4"></div>
                                    </div>
                                    <div class="col-md-2 float-right">
                                        <div class="form-group mt-2">
                                            <button type="submit" name="save_category"
                                                class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="mt-4">
                        <h4 style="font-size:20px;color:#1C2434;margin:40px 0 20px 3px">Products</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th>ID</th>
                                        <th>title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM products ORDER BY id DESC";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $i = 1;
                                        foreach ($query_run as $prod_item) {
                                            ?>
                                            <tr style="text-align:center;">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $prod_item['title']; ?></td>
                                                <td style="width:12%; padding: 0;"><img src="<?php
                                                $cat_id = $prod_item['id'];
                                                $img = "SELECT * FROM `products_image` WHERE p_id=$cat_id";
                                                $img_run = mysqli_query($conn, $img);
                                                $image = mysqli_fetch_assoc($img_run);
                                                echo 'uploads/products/' . $image['image'];
                                                ?>"
                                                        style="height:auto; width:100%; border-radius:0px; display: block;" />
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input class="status" data-id="<?php echo $prod_item['id']; ?>"
                                                            data-table="products"
                                                            data-status="<?php echo $prod_item['status']; ?>" type="checkbox"
                                                            <?php if ($prod_item['status'] == 1) { ?>checked<?php } ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td><?php echo $prod_item['created_at']; ?></td>
                                                <td>
                                                    <a href="edit_products.php?prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-info">Edit</a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger user_delete_btn"
                                                        data-id="<?php echo $prod_item['id']; ?>"
                                                        data-table="products">Delete</button>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8">No Record found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        tinymce.init({
            selector: '#description, #addinfo',
            menubar: false,
            plugins: 'lists link image',
            toolbar: 'undo redo | bold italic | bullist numlist outdent indent | link image'
        });

        document.getElementById('addTab').addEventListener('click', function () {
            const selectedTab = document.getElementById('tabs').value;
            if (selectedTab) {
                addTextEditor(selectedTab);
            }
        });

        function addTextEditor(tabName) {
            const editorId = 'editor_' + Date.now();
            const editorContainer = document.createElement('div');
            editorContainer.classList.add('form-group');
            editorContainer.innerHTML = `
                <label for="${editorId}">${tabName}</label>
                <textarea id="${editorId}" name="${tabName.toLowerCase()}[]" class="form-control"></textarea>
            `;
            document.getElementById('textEditorsContainer').appendChild(editorContainer);

            // Initialize TinyMCE for the new textarea
            tinymce.init({
                selector: `#${editorId}`,
                menubar: false,
                plugins: 'lists link image',
                toolbar: 'undo redo | bold italic | bullist numlist outdent indent | link image'
            });
        }
    });
</script>
<?php include ("footer.php"); ?>