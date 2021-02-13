<?php
require_once('head.php');
require_once("navigation.php");
?>
<div class="container">

    <h2>Create Account</h2>

    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-tailor-tab" data-toggle="tab" href="#nav-tailor" role="tab"
                   aria-controls="nav-tailor" aria-selected="true">Tailor</a>
                <a class="nav-item nav-link" id="nav-customer-tab" data-toggle="tab" href="#nav-customer" role="tab"
                   aria-controls="nav-customer" aria-selected="false">Customer</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-tailor" role="tabpanel" aria-labelledby="nav-tailor-tab">
                <form class="container" action="../Private/functions.php" method="post">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname">
                    </div>

                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname">
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email">
                    </div>

                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" class="form-control" id="uname">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit-tailor">Submit</button>
                </form>
            </div>

            <div class="tab-pane fade" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
                <form class="container" action="../Private/functions.php" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email">
                    </div>

                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" class="form-control" id="uname">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit-visitor">Submit</button>
                </form>

            </div>

        </div>
    </div>
</div>
<?php
require_once('footer.php');
?>