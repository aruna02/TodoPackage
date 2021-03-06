@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="container mb-4">
        <h4>
            <span class="todo-fonts"> Todos </span>
            <input type="text" name="name" class="search_by_name" placeholder="search by name...">
            <button class="add_todo btn btn-primary text-white btn-purple" data-original-title="Add todo"><i
                    class="fa fa-plus"></i></button>
        </h4>
    </div>

    <div class="add_todo_div container mb-4" style="display: none;">
        <div class="row">
            <div class="col-8 ml-3">
                <input type="text" name="text" class="todo_input form-control" placeholder="Enter Todo">
                <span class="text-danger danger_span" style="display:none">this field is empty</span>
            </div>
            <div class="col-2">
                <a type="button" class="btn btn-success text-white add_btn">Add</a>
                <a type="button" class="btn btn-danger text-white cancel_btn">Cancel</a>
            </div>

        </div>
    </div>

    <div class="container mt-3 panel_div">
        <div class="col-10 card_body">


        </div>
    </div>
    </div>

    <script type="text/javascript">
        $('document').ready(function() {
            showlist();

            //for add btn
            $('.add_btn').on('click', function() {
                if ($('.todo_input').val() == '') {
                    $('.danger_span').show();
                } else {
                    $('.danger_span').hide();
                    var todo_data = $('.todo_input').val();
                    $.ajax({
                        type: 'POST',

                        url: '/todo/add/',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "description": todo_data,
                        },

                        success: function(data) {
                            debugger;
                            $('.todo_input').val('');
                            showlist();
                            $('.panel_div').show();

                            // $('.add_todo_div').hide();
                        }
                    });

                }
            });

            //for cancel btn
            $('.cancel_btn').on('click', function() {
                $('.danger_span').hide();
                $('.todo_input').val('');
            });


            //for add todo btn
            $('.add_todo').on('click', function() {
                $('.add_todo_div').show();
            });

            //for input field
            $("input[type='text']").keyup(function() {
                $('.danger_span').hide();
            });

            $('.search_by_name').on('keyup', function() {

                var name = $(this).val();
                if (name != '') {
                    $.ajax({
                        type: 'GET',

                        url: '/todo/search/' + name,



                        success: function(data) {

                            $('.card_body').html(data);
                            $('.panel_div').show();
                        }
                    });
                } else {
                    showlist();

                }


            });

        });

        function showlist() {
            $.ajax({
                type: 'GET',

                url: '/todo/2',


                success: function(data) {
                    $('.card_body').html(data);
                    $('.panel_div').show();
                }
            });
        }
    </script>



@endsection
