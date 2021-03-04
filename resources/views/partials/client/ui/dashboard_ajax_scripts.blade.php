<script src="{{asset('client/js/Chart.bundle.js')}}"></script>
<script src="{{asset('client/js/utils.js')}}"></script>
<script>

    $(document).ready(function() {

        $('.setting-icon').on('click', function (e) {
            $('.filter-options').toggleClass("active");
            e.preventDefault();
        });

        $('input[name="sort_date"]').daterangepicker({
            opens: 'bottom',
            autoUpdateInput: false,
        });

        var share_clipboard = new ClipboardJS('#btn-copy');
        share_clipboard.on('success', function(e) {
            alert("Copied!");
            e.clearSelection();
        });
    });

    function getMonthlyReport(link_id) {
        $.ajax({
            url:"{{route('get.link.monthly.report')}}",
            type:"POST",
            data:{
                link_id:link_id,
                '_token':"{{csrf_token()}}"
            },
            success:function(data) {
                var Years = new Array();
                var Months = new Array();
                var Labels = new Array();
                var Clicks = new Array();
                data.monthly_report.forEach(function(data){
                    Months.push(data.month);
                    //Labels.push(data.stockName);
                    Clicks.push(data.total_clicks);
                });
                var ctx = document.getElementById("canvas").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                        labels:Months,
                        datasets: [{
                            label: 'Total Clicks',
                            data: Clicks,
                            borderWidth: 1,
                            borderColor:[
                                'red',    
                                'rgba(0,0,230,0.5)',   
                                'green', 
                                'black',
                                'purple',
                                'yellow',
                                'pink',
                                'orange',
                                'grey',
                                'brown',
                                'cyan',
                                'violet'
                            ],
                            backgroundColor:[
                                'rgba(250,0,0,0.2)',    
                                'rgba(0,0,230,0.5)',   //rgba(0,0,230,0.5)
                                'rgba(0,117,0.5)', 
                                'rgba(0,0,0)',
                                'purple',
                                'yellow',
                                'pink',
                                'orange',
                                'grey',
                                'brown',
                                'cyan',
                                'violet'
                            ]
                        }],
                  },
                  options: {
                      responsive:true,
                      maintainAspectRation:false,
                      scales: {
                            yAxes: [{
                                display:true,
                                ticks: {
                                    beginAtZero:true,
                                    steps:1,
                                    stepValue:1,
                                    stepSize:1
                                }
                            }]
                      }
                  }
                });
                
                $.ajax({
                    url:"{{route('get.link.map')}}",
                    type:"POST",
                    data:{
                        link_id:link_id,
                        '_token':"{{csrf_token()}}"
                    },
                    success:function(data1) {
                        // Initiate the chart
                        Highcharts.mapChart('container', {
                            chart: {
                                map: 'custom/world'
                            },

                            title: {
                                text: 'Zoom in on country by double click'
                            },

                            mapNavigation: {
                                enabled: true,
                                enableDoubleClickZoomTo: true
                            },

                            colorAxis: {
                                min: 1,
                                max: 1000,
                                type: 'logarithmic'
                            },

                            series: [{
                                data: data1,
                                joinBy: ['iso-a3', 'code3'],
                                name: 'Population density',
                                states: {
                                    hover: {
                                        color: '#a4edba'
                                    }
                                },
                                tooltip: {
                                    valueSuffix: 'Clicks'
                                }
                            }]
                        });
                    }
                });
                
            }
        }).done(function() {
            setTimeout(function() {
                $('#overlay').fadeOut(300);
            },500);
        });
    }

    function addToFavorites(link_id,favorite_id) {
        if(link_id != "" && favorite_id != "") {                
            $.ajax({
                url:"{{route('delete.favorite')}}",
                type:"post",
                data:{
                    link_id:link_id,
                    favorite_id:favorite_id,
                    '_token':"{{csrf_token()}}"
                },
                success:function(data) {
                    if(data.status == "fail") {
                        Swal.fire({ 
                            type: "error", 
                            title: "Failed!", 
                            text: data.msg, 
                            showCancelButton: 1,
                        })
                    } else {
                        get_link_details("all","","");
                        $("#favorite-"+link_id+" i").removeClass('active');
                    }
                }
            }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
            });
        } else if(link_id != "") {
            $.ajax({
                url:"{{route('add.to.favorite')}}",
                type:"post",
                data:{
                    link_id:link_id,
                    '_token':"{{csrf_token()}}"
                },
                success:function(data) {
                    if(data.status == "fail") {
                        Swal.fire({ 
                            type: "error", 
                            title: "Failed!", 
                            text: data.msg, 
                            showCancelButton: 1,
                        })
                    } else {
                        get_link_details("all","","");
                        $("#favorite-"+link_id+" i").addClass('active');
                    }
                }
            }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
            }); 
        }
    }

    $('.bottom-area .hide-link i').click(function () {
        var link_id = $(this).attr('data-link_id');
        if(link_id != "") {
            Swal.fire({ 
                title: "Are you sure?", 
                text: "You want to hide this link from dashboard?", 
                type: "warning", 
                showCancelButton: !0, 
                confirmButtonColor: "#3085d6", 
                cancelButtonColor: "#d33", 
                confirmButtonText: "Confirm", 
                confirmButtonClass: "btn btn-primary", 
                cancelButtonClass: "btn btn-danger ml-1", 
                buttonsStyling: !1 
            }).then(function (confirm) { 
                if(confirm.value == true) {
                    $.ajax({
                        url:"{{route('dashboard.link.change.status')}}",
                        type:"post",
                        data:{
                            link_id:link_id,
                            '_token':"{{csrf_token()}}",
                            'action':'hide'
                        },
                        success:function(data) {
                            if(data.status == "success") {
                                get_link_details("all","","");
                            } else {
                                Swal.fire({ 
                                    type: "error", 
                                    title: "Failed!", 
                                    text: data.msg, 
                                    showCancelButton: 1,
                                })
                            }
                        }
                    }).done(function() {
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                    });    
                }
            });
        }
    });

    $('.bottom-area .delete-link').click(function () {
        var link_id = $(this).attr('data-link_id');
        if(link_id != "") {
            Swal.fire({ 
                title: "Are you sure?", 
                text: "You want to delete this link?", 
                type: "warning", 
                showCancelButton: !0, 
                confirmButtonColor: "#3085d6", 
                cancelButtonColor: "#d33", 
                confirmButtonText: "Confirm", 
                confirmButtonClass: "btn btn-primary", 
                cancelButtonClass: "btn btn-danger ml-1", 
                buttonsStyling: !1 
            }).then(function (confirm) { 
                if(confirm.value == true) {
                    $.ajax({
                        url:"{{route('dashboard.link.delete')}}",
                        type:"post",
                        data:{
                            link_id:link_id,
                            '_token':"{{csrf_token()}}"
                        },
                        success:function(data) {
                            if(data.status == "success") {
                                Swal.fire({ 
                                    type: "success", 
                                    title: "Done!", 
                                    text: "Link deleted successfully.", 
                                    confirmButtonClass: "btn btn-success" 
                                }).then(function(confirm) {
                                    if(confirm) {
                                        get_link_details("all","","");
                                    }  
                                }) 
                            } else {
                                Swal.fire({ 
                                    type: "error", 
                                    title: "Failed!", 
                                    text: data.msg, 
                                    showCancelButton: 1,
                                })
                            }
                        }
                    }).done(function() {
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                    });   
                }
            });
        }
    });

    $(document).on('click', 'a.share-link', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            dataType: 'html',
            success: function(res) {
                if(res == "fail") {
                    Swal.fire({ 
                        type: "error", 
                        title: "Failed!", 
                        text: "Unable to fetch link details. Please try again later.", 
                        showCancelButton: 1,
                    })
                } else {
                    $('#GroupLinksModal').modal('hide');
                    setTimeout(function () {
                        $('#share-link').html(res).modal('show');
                    },300);
                }   
            }
        }).done(function() {
            setTimeout(function() {
                $('#overlay').fadeOut(300);
            },500);
        });
    });

    $(document).on('click', 'a.btn-view-group-links', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            dataType: 'html',
            success: function (res) {
                if (res == "fail") {
                    Swal.fire({
                        type: "error",
                        title: "Failed!",
                        text: "Unable to fetch group links. Please try again later.",
                        showCancelButton: 1,
                    })
                } else {
                    $('#GroupLinksModal')
                        .html(res)
                        .modal('show');
                }
            },
            error: function () {
                setTimeout(function () {
                    $('#GroupLinksModal').modal('hide');
                    $('#overlay').fadeOut(300);
                }, 500);
            }
        }).done(function () {
            setTimeout(function () {
                $('#overlay').fadeOut(300);
            }, 500);
        });
    });

    $(document).on('click','a.delete-group-link', function() {
        var map_id = $(this).attr('data-link_map_id');
        Swal.fire({ 
            title: "Are you sure?", 
            text: "You want to delete this link from group?", 
            type: "warning", 
            showCancelButton: !0, 
            confirmButtonColor: "#3085d6", 
            cancelButtonColor: "#d33", 
            confirmButtonText: "Yes, delete it", 
            confirmButtonClass: "btn btn-primary", 
            cancelButtonClass: "btn btn-danger ml-1", 
            buttonsStyling: !1 
        }).then(function (confirm) { 
            if(confirm.value == true) {
                $.ajax({
                    url:"{{route('group.link.delete')}}",
                    type:"post",
                    data:{
                        map_id:map_id,
                        '_token':"{{csrf_token()}}"
                    },
                    success:function(data) {
                        if(data.status == "success") {
                            Swal.fire({ 
                                type: "success", 
                                title: "Done!", 
                                text: data.msg, 
                                confirmButtonClass: "btn btn-success" 
                            }).then(function(confirm) {
                                if(confirm.value == true) {
                                    $('#Link-Row-'+map_id).fadeOut();
                                }  
                            }) 
                        } else {
                            Swal.fire({ 
                                type: "error", 
                                title: "Failed!", 
                                text: data.msg, 
                                showCancelButton: 1,
                            })
                        }
                    },
                    error:function() {
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                }); 
            }
        });
    });

    $(document).on('click','button.btn-delete-group', function() {
        var group_id = $(this).attr('data-group_id');
        Swal.fire({ 
            title: "Are you sure?", 
            text: "You want to delete this group and its links?", 
            type: "warning", 
            showCancelButton: !0, 
            confirmButtonColor: "#3085d6", 
            cancelButtonColor: "#d33", 
            confirmButtonText: "Yes, delete it", 
            confirmButtonClass: "btn btn-primary", 
            cancelButtonClass: "btn btn-danger ml-1", 
            buttonsStyling: !1 
        }).then(function (confirm) { 
            if(confirm.value == true) {
                $.ajax({
                    url:"{{route('delete.link.group')}}",
                    type:"POST",
                    data:{
                        group_id:group_id,
                        '_token':"{{csrf_token()}}"
                    },
                    success:function(data) {
                        if(data.status == "success") {
                            Swal.fire({ 
                                type: "success", 
                                title: "Done!", 
                                text: data.msg, 
                                confirmButtonClass: "btn btn-success" 
                            }).then(function(confirm) {
                                if(confirm.value == true) {
                                    location.reload();
                                }  
                            }) 
                        } else {
                            Swal.fire({ 
                                type: "error", 
                                title: "Failed!", 
                                text: data.msg, 
                                showCancelButton: 1,
                            })
                        }
                    },
                    error:function() {
                        setTimeout(function() {
                            $('#overlay').fadeOut(300);
                        },500); 
                    }
                }).done(function() {
                    setTimeout(function() {
                        $('#overlay').fadeOut(300);
                    },500);
                });
            }
        });
    });

    function shareFBLink(short_link) {
        var facebookWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + short_link, 'facebook-popup', 'height=350,width=600');
        if (facebookWindow.focus) { facebookWindow.focus(); }
        return false;
    }

    function shareTwitterLink(short_link, referer) {
        var twitterWindow = window.open('https://twitter.com/intent/tweet?url=' + short_link + '&text=' + short_link + '&original_referer=' + referer + ',Flinks,share');
        if (twitterWindow.focus) { twitterWindow.focus(); }
        return false;
    }

    function shareLinkedinLink(short_link, link_title, website_url) {
        var linkedinWindow = window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + short_link + '&title=' + link_title + '&summary=' + link_title + '&source=' + website_url);
        if (linkedinWindow.focus) { linkedinWindow.focus(); }
        return false;
    }

    function shareMailLink(short_link, link_title) {
        var mailWindow = window.open('mailto:?subject=Sharing You Short Link&body=' + link_title + encodeURIComponent('\r\n') + short_link);
        if (mailWindow.focus) { mailWindow.focus(); }
        return false;
    }

    $('#FilterLinks').validate({
            rules:{
                sort_by:{
                    required:true
                }
            },
            submitHandler:function(form) {
                $.ajax({
                    url:"{{route('sort.link')}}",
                    type:"POST",
                    data:{
                        sort_by:$('#sort_by').val(),
                        sort_date:$('#dt').val(),
                        '_token':"{{csrf_token()}}"
                    },
                    success:function(res) {
                        if(res.status == "200") {
                            $('.links-list-block').html(res.data);
                            var link_id = $(".nav-pills .nav-link.active").attr("data-link_id");
                            if(link_id > 0) {
                                getSingleLink(link_id);
                            }
                        } else if(res.status == "204") {
                            $('.links-section').html("");
                            $('.links-section').html(res.data);
                        }
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                });
            }
        });
    
    

    // function setTooltip(selector, message) {
    //     $(selector).data("placement", "bottom").attr("title", message).tooltip();
    // }

    // function hideTooltip(selector) {
    //     setTimeout(function() {
    //         $(selector).tooltip().fadeOut;
    //     }, 1000);
    // }

    var clipboard = new ClipboardJS('.btn-copy-group-link');
    clipboard.on('success', function(e) {
        alert('Copied!');
        e.clearSelection();
    });

    function copyLink(link_id) {
        var selector = '#copy-link-'+link_id;
        var clipboard = new ClipboardJS(selector);
        clipboard.on('success', function(e) {
            alert("Copied!");
            e.clearSelection();
        });
    } 

</script>