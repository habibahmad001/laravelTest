<!DOCTYPE html>
<html lang="en">
<head>
  <title>CT Skill</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="./slick/slick.css?v2022">
  <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css?v2022">
  <link rel="stylesheet" type="text/css" href="./css/main.css?v2022">
  <link rel="stylesheet" type="text/css" href="./css/dataTables.dataTables.css?v2022">
</head>
<body>
<div class="spineroverlay" style="display: none;">
    <div class="loader"></div>
</div>


<header id="header">
    <section>
      <div class="row">
        <div class="col-12 p3">
        </div>
      </div>
    </section>
</header>
<div class="container">
    <section>
        <form name="frm" id="frm" action="/" method="post">
            <div class="row card p1">
{{--                <div class="form-group col-sm-12 col-md-6 col-lg-6">--}}
{{--                    <label>Product Name</label>--}}
{{--                    <p>--}}
{{--                        <input type="file" class="form-control" name="logo" id="logo" />--}}
{{--                    </p>--}}
{{--                </div>--}}
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label>Product Name</label>
                    <p>
                        <input type="text" class="form-control" name="name" id="name" placeholder="i.e shoes" value="" required />
                    </p>
                </div>

                <div class="form-group  col-sm-12 col-md-12 col-lg-12">
                    <label>Product Quantity</label>
                    <p>
                        <input type="text" class="form-control" name="qty" id="qty" placeholder="i.e 10" value="" required />
                    </p>
                </div>

                <div class="form-group  col-sm-12 col-md-12 col-lg-12">
                    <label>Product in stock</label>
                    <p>
                        <input type="text" class="form-control" name="stock" id="stock" placeholder="i.e 50" value="" required />
                    </p>
                </div>

                <div class="form-group  col-sm-12 col-md-12 col-lg-12">
                    <label>Product Price per item</label>
                    <p>
                        <input type="text" class="form-control" name="price" id="price" placeholder="i.e 600" value="" required />
                    </p>
                </div>
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <button type="button" name="submit_btn" id="submit_btn" class="form-control btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </section>

    <section class="spacer">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </section>

    <section>
        <div class="row card p1">
            <div class="editable-error-block"></div>
            <div class="col-sm-12 col-md-12 col-lg-12 populatedata">
                @include("inc/inc_stocktable")
            </div>
        </div>
    </section>
</div>

<footer id="header">
    <section>
        <div class="row">
            <div class="col-12 p3">
            </div>
        </div>
    </section>
</footer>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./js/bootstrap-editable.min.js?3423423423"></script>
  <script language="JavaScript">
      var csrf_token = "<?php echo csrf_token() ?>";
  </script>
  <script src="./js/inventory.js?v2022"></script>
  <script src="./js/dataTables.js"></script>

</body>
</html>
