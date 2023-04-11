
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo $active == 'home' ? 'active' : '';?>" aria-current="page"
                    href="/dgp/sistema">
                    <span class="align-text-bottom"></span>
                    Página Inicial
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $active == 'colaborador' ? 'active' : '';?>"
                    href="/dgp/sistema/colaborador">
                    <span  class="align-text-bottom"></span>
                    Minha Área 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $active == 'RH' ? 'active' : '';?>" href="/dgp/sistema/RH/indexinicial.php">
                   
                    Dpt Pessoal 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $active == 'Financeiro' ? 'active' : '';?>" href="/dgp/sistema/Financeiro">
                   
                    Gerência Financeira
                </a>
            
        </ul>
    </div>
</nav>