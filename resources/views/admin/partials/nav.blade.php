<body style="background-color:rgba(6,3,1,0.96);">
<ul class="sidebar-menu" data-widget="tree">

    <li class="header">MENU DE NAVEGACIÓN</li>
    <li class="{{setActiveRoute('dashboard')}}">
        <a href="{{route('dashboard')}}"><i class="fa fa-home"></i> <span>Inicio</span></a>
    </li>

    {{--PERSONAL--}}
        @if(auth()->user()->type === 'Empleado')
        <li class="treeview {{ setActiveRoute(['admin.employees.index', 'admin.customers.index', 'admin.roles.index', 'admin.permissions.index', 'admin.bitacora.index'])}}">
            <a href="#"><i class="fa fa-address-book"></i> <span>Administración de Usuarios</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li class="{{setActiveRoute('admin.employees.index')}}">
                    <a href="{{route('admin.employees.index')}}"><i class="fa fa-users"></i> Gestionar Empleados</a>
                </li>
                @can('create', new App\Customer)
                <li class="{{setActiveRoute('admin.customers.index')}}">
                    <a href="{{route('admin.customers.index')}}"><i class="fa fa-user-circle"></i> Gestionar Clientes</a>
                </li>
                @endcan

                @can('view', new \Spatie\Permission\Models\Role)
                    <li class="{{setActiveRoute('admin.roles.index')}}">
                        <a href="{{route('admin.roles.index')}}"><i class="fa fa-id-card"></i> Gestionar Roles</a>
                    </li>
                @endcan

                @can('view', new \Spatie\Permission\Models\Permission)
                    <li class="{{setActiveRoute('admin.permissions.index')}}">
                        <a href="{{route('admin.permissions.index')}}"><i class="fa fa-id-card-o"></i> Administrar Permisos</a>
                    </li>
                @endcan

                <li class="{{setActiveRoute('admin.bitacora.index')}}">
                    <a href="{{route('admin.bitacora.index')}}"><i class="fa fa-file-text"></i> Bitácora</a>
                </li>

            </ul>
        </li>

        {{--PRODUCTOS--}}
        <li class="treeview {{ setActiveRoute(['admin.products.index','admin.categories.index','admin.brands.index','admin.units.index'])}}">
            <a href="#"><i class="fa fa-cubes"></i> <span>Productos</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>

            <ul class="treeview-menu">
                @can('view', new App\Product)
                    <li class="{{setActiveRoute('admin.products.index')}}">
                        <a href="{{route('admin.products.index')}}"><i class="fa fa-shopping-basket"></i> Gestionar Productos</a>
                    </li>
                @endcan

                @can('view', new App\Category)
                    <li class="{{setActiveRoute('admin.categories.index')}}">
                        <a href="{{route('admin.categories.index')}}"><i class="fa fa-linode"></i> Gestionar Categorias</a>
                    </li>
                @endcan

                @can('view', new App\Brand)
                    <li class="{{setActiveRoute('admin.brands.index')}}">
                        <a href="{{route('admin.brands.index')}}"><i class="fa fa-pencil-square-o"></i> Gestionar Marcas</a>
                    </li>
                @endcan

                @can('view', new App\Unity)
                    <li class="{{setActiveRoute('admin.units.index')}}">
                        <a href="{{route('admin.units.index')}}"><i class="fa fa-database"></i> Gestionar Unidades</a>
                    </li>
                @endcan
            </ul>
        </li>

        {{--INVENTARIOS--}}
        <li class="treeview {{ setActiveRoute(['admin.inventories.index','admin.warehouses.index','admin.branchOffices.index','admin.providers.index'])}}">
            <a href="#"><i class="fa fa-tasks"></i> <span>Inventarios</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">

                @can('view', new App\Provider)
                    <li class="{{setActiveRoute('admin.providers.index')}}">
                        <a href="{{route('admin.providers.index')}}"><i class="fa fa-users"></i>Gestionar Proveedores</a>
                    </li>
                @endcan

                @can('view', new App\BranchOffice)
                    <li class="{{setActiveRoute('admin.branchOffices.index')}}">
                        <a href="{{route('admin.branchOffices.index')}}"><i class="fa fa-university"></i>Gestionar Sucursales</a>
                    </li>
                @endcan

                @can('view', new App\Warehouse())
                    <li class="{{setActiveRoute('admin.warehouses.index')}}">
                        <a href="{{route('admin.warehouses.index')}}"><i class="fa fa-building"></i>Gestionar Almacenes</a>
                    </li>
                @endcan

                @can('view', new App\Inventory())
                    <li class="{{setActiveRoute('admin.inventories.index')}}">
                        <a href="{{route('admin.inventories.index')}}"><i class="fa fa-building"></i>Gestionar Inventarios</a>
                    </li>
                @endcan

            </ul>
        </li>

        {{--COMPRAS--}}
        <li class="treeview {{ setActiveRoute(['admin.ingresos.index','admin.promotions.index','admin.combos.index', 'reporte_compra'])}}">
            <a href="#"><i class="fa fa-shopping-cart"></i> <span>Compras</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                @can('view', new App\Ingreso)
                    <li class="{{setActiveRoute('admin.ingresos.index')}}">
                        <a href="{{route('admin.ingresos.index')}}"><i class="fa fa-pie-chart" aria-hidden="true"></i>Gestionar compras</a>
                    </li>
                @endcan

                    <li class="{{setActiveRoute('admin.promotions.index')}}">
                        <a href="{{route('admin.promotions.index')}}"><i class="fa fa-universal-access"></i>Gestionar Promociones</a>
                    </li>

                    <li class="{{setActiveRoute('admin.combos.index')}}">
                        <a href="{{route('admin.combos.index')}}"><i class="fa fa-linode"></i>Gestionar Combos</a>
                    </li>

                    <li class="{{setActiveRoute('reporte_compra')}}">
                        <a href="{{url('/admin/reporte_compras')}}"><i class="fa fa-circle"></i>Reportes de Compras</a>
                    </li>
            </ul>
        </li>

    {{--VENTAS--}}
    <li class="treeview {{ setActiveRoute(['admin.egresos.index','admin.pedidos.index','reporte_venta'])}}">
        <a href="#"><i class="fa fa-credit-card"></i> <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @can('view', new App\Egreso)
                <li class="{{setActiveRoute('admin.egresos.index')}}">
                    <a href="{{route('admin.egresos.index')}}"><i class="fa fa-shopping-bag"></i>Gestionar ventas</a>
                </li>
            @endcan
            @can('view', new App\Pedido())
                <li class="{{setActiveRoute('admin.pedidos.index')}}">
                    <a href="{{route('admin.pedidos.index')}}"><i class="fa fa-credit-card-alt"></i>Gestionar pedidos</a>
                </li>
            @endcan
                <li class="{{setActiveRoute('reporte_venta')}}">
                    <a href="{{url('/admin/reporte_ventas')}}"><i class="fa fa-archive"></i>Reportes de Ventas</a>
                </li>
        </ul>
    </li>

    {{--SEGURIDAD Y RESPALDO--}}
        <li class="treeview {{ setActiveRoute(['admin.backup.index'])}}">
        <a href="#"><i class="fa fa-key"></i> <span>Seguridad y Respaldo</span>
            <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
        </a>
        <ul class="treeview-menu">

            <li class="{{setActiveRoute('admin.backup.index')}}">
                <a href="{{route('admin.backup.index')}}"><i class="fa fa-copy"></i>Copia de Seguridad (Backup)</a>
            </li>

        </ul>
    </li>

    @elseif(auth()->user()->type === 'Cliente')
        <?php
            $customers=\App\Customer::all();
            $id_customer=null;
            foreach ($customers as $customer){
                if ($customer->user_id === auth()->user()->id){
                    $id_customer=$customer->id;
                }
            }
        ?>
        @if($id_customer!=null)
            <li class="{{setActiveRoute(['admin.customers.show', 'admin.customers.edit'])}}">
                <a href="{{route('admin.customers.show',$id_customer)}}"><i class="fa fa-user"></i> Perfil</a>
            </li>
        @endif
        <li class="{{setActiveRoute('admin.pedidos.index')}}">
            <a href="{{route('admin.pedidos.index')}}"><i class="fa fa-credit-card-alt"></i> Mis Solicitudes</a>
        </li>

    @elseif(auth()->user()->type === 'Proveedor')
        <?php
            $providers=\App\Provider::all();
            $id_provider=null;
            foreach ($providers as $provider){
                if ($provider->user_id === auth()->user()->id){
                    $id_provider=$provider->id;
                }
            }
        ?>
        @if($id_provider!=null)
            <li class="{{setActiveRoute(['admin.providers.show', 'admin.providers.edit'])}}">
                <a href="{{route('admin.providers.show',$id_provider)}}"><i class="fa fa-user"></i> Perfil</a>
            </li>
        @endif
    @endif

    <li><a href="https://drive.google.com/drive/folders/1cgpQeVANuF5C9EK0P3K6GJheLkWbKAcs"><i class="fa fa-book"></i> <span>Documentación</span></a></li>
    <li class="header">ETIQUETAS</li>
    <li><a href="https://drive.google.com/drive/folders/1cgpQeVANuF5C9EK0P3K6GJheLkWbKAcs"><i class="fa fa-circle-o text-aqua"></i> <span>Información</span></a></li>
</ul>