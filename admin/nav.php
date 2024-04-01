<?php
echo '
<!-- Sidebar -->
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-primary text-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-2 mt-3">
                <a href="admin"  class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
                    <i class="bi bi-person-add me-3"></i><span>Create Accounts</span></a>

                <a href="request"  class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
                    <i class="bi bi-card-checklist me-3 text-white"></i><span>Password Request</span></a>

                <a href="" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
                    ><i class="bi bi-person me-3 text-white"></i><span>My Account</span></a>

                    <a href="../logout" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white"
                    ><i class="bi bi-box-arrow-right me-3 text-white"></i><span>Logout</span></a>
            </div>
        </div>
    </nav>';
?>