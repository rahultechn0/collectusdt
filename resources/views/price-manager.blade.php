@include('adminCommon.header')
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
    @include('adminCommon.sidebar')
    <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            @include('adminCommon.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="heading">
                        <h3 class="mb-30 text-gray-800 font-weight-bold">Price Manager</h3>
                    </div>

         
                </div>
            </div>
            <!-- End of Main Content -->







    <div class="profile-form pt-20">
        {!! Form::open(["url"=>"savePrice","method"=>"POST","autocomplete"=>"off"]) !!}
        
            @foreach( $currencylist as $list )
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-outline mb-3">
                        <label for="sdf">Symbol</label>
                        <input type="text" id="form3Example3" class="form-control" name="name_Arr_@php echo $list['id'];@endphp" value="@php echo $list['name']; @endphp" readonly="readonly">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-outline mb-3">
                        <label for="sdf">Price (INR)</label>
                        <input type="text" id="form3Example3" class="form-control" name="price_Arr_@php echo $list['id'];@endphp" value="@php echo $list['price']; @endphp">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-outline mb-3">
                        <label for="sdf">
                            @if($list['c_type']=="DAO")
                            APY    
                            @else
                            APR
                            @endif
                            %
                        </label>
                        <input type="text" id="form3Example3" class="form-control" name="apy_Arr_@php echo $list['id'];@endphp" value="@php echo $list['apy']; @endphp">
                    </div>
                </div> 
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-outline mb-3">
                        <label for="sdf">Locking Period( in Months)</label>
                        <input type="number" id="form3Example3" class="form-control" name="lockingPeriod_Arr_@php echo $list['id'];@endphp" value="@php echo $list['lockingPeriod']; @endphp">
                    </div>
                </div> 
            </div> 
            @endforeach
        <div class="row">    
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="text-right text-lg-start ">
                    <button type="submit" class="btn btn-lg">Save</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!} 

    </div>





<style>
    .profile-form{width: 93% !important;}
</style>

        @include('adminCommon.footer')