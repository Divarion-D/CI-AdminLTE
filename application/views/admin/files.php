<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1><?php echo $page_title; ?></h1>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">


<?php echo $error;?>

<?php echo form_open_multipart('admin/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>


                        </div>
                    </div>
                </section>
            </div>
