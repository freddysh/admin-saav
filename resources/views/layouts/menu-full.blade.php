<div class="menu-list">
        <ul id="menu-content" class="menu-content collapsed menu1">
            <li>
              <a href="#">
              <i class="fa fa-eye fa-lg"></i> Dashboard
              </a>
            </li>
            <li data-toggle="collapse" data-target="#ventas" class="collapsed active1">
              <a href="#"><i class="fa fa-gift fa-lg"></i> VENTAS <span class="fas fa-arrow-circle-down"></span></a>
            </li>
            <ul class="sub-menu collapse menu2" id="ventas">
                <li data-toggle="collapse" class="active1"><a href="#"><i class="fa fa-eye fa-lg"></i> INVENTORY <span class="fas fa-arrow-circle-down"></span></a></li>
                <li data-toggle="collapse" data-target="#sales" class="active1"><a href="#"><i class="fa fa-eye fa-lg"></i> SALES <span class="fas fa-arrow-circle-down"></span></a></li>
                <ul class="sub-menu collapse menu2" id="sales">
                  @foreach ($webs as $item)
                    <li><a href="#"><i class="fa fa-eye fa-lg"></i> {{$item->pagina}}</a></li>
                  @endforeach
                </ul>
                <li><a href="#">Typography</a></li>
                <li><a href="#">FontAwesome</a></li>
                <li><a href="#">Slider</a></li>
                <li><a href="#">Panels</a></li>
                <li><a href="#">Widgets</a></li>
                <li><a href="#">Bootstrap Model</a></li>
            </ul>

            <li data-toggle="collapse" data-target="#service" class="collapsed">
              <a href="#"><i class="fa fa-globe fa-lg"></i> Services <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="service">
              <li>New Service 1</li>
              <li>New Service 2</li>
              <li>New Service 3</li>
            </ul>


            <li data-toggle="collapse" data-target="#new" class="collapsed">
              <a href="#"><i class="fa fa-car fa-lg"></i> New <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="new">
              <li>New New 1</li>
              <li>New New 2</li>
              <li>New New 3</li>
            </ul>


             <li>
              <a href="#">
              <i class="fa fa-user fa-lg"></i> Profile
              </a>
              </li>

             <li>
              <a href="#">
              <i class="fa fa-users fa-lg"></i> Users
              </a>
            </li>
        </ul>
 </div>