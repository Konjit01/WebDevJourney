<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url(); ?>categories/">Quest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="mx-auto" role="search" action="<?php echo base_url(); ?>units/search_units" method="POST">
                <div class="input-group">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search for contents..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button> 
                </div>
            </form>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>questions/index">Q&A &nbsp;</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>units/aboutus">ABOUT</a>
                </li>
                <?php if ($this->session->userdata('logged_in')): ?> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CREATE</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>units/create">Articles</a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>categories/create">Categories</a>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (!$this->session->userdata('logged_in')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>users/login">LOGIN</a>
                    </li>
                <?php endif; ?>

                <?php if ($this->session->userdata('logged_in')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo " "; ?><?php echo '<strong>' . ucfirst($this->session->userdata('last_name')); ?></strong>
                            <!--<img src="<?php echo base_url(); ?>uploads/<?php echo $user['profile_pic']; ?>" width="40" height="40" class="img-fluid rounded-circle ml-2">-->
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>units/create">DASHBOARD</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>users/profile_settings">EDIT PROFILE</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>users/logout">LOGOUT</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>








