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
                
                $('#map1').vectorMap({
                    map: 'world_mill_en',
                    panOnDrag: true,
                    focusOn: {
                        x: 0.5,
                        y: 0.5,
                        scale: 1,
                        animate: true
                    },
                    series: {
                        regions: [{
                            scale: ['#E1E1E1', '#51A3ED'],
                            normalizeFunction: 'polynomial',
                            values: {
                                "AF": 16.63,
                                "AL": 11.58,
                                "DZ": 158.97,
                                "AO": 85.81,
                                "AG": 1.1,
                                "AR": 351.02,
                                "AM": 8.83,
                                "AU": 1219.72,
                                "AT": 366.26,
                                "AZ": 52.17,
                                "BS": 7.54,
                                "BH": 21.73,
                                "BD": 105.4,
                                "BB": 3.96,
                                "BY": 52.89,
                                "BE": 461.33,
                                "BZ": 1.43,
                                "BJ": 6.49,
                                "BT": 1.4,
                                "BO": 19.18,
                                "BA": 16.2,
                                "BW": 12.5,
                                "BR": 2023.53,
                                "BN": 11.96,
                                "BG": 44.84,
                                "BF": 8.67,
                                "BI": 1.47,
                                "KH": 11.36,
                                "CM": 21.88,
                                "CA": 1563.66,
                                "CV": 1.57,
                                "CF": 2.11,
                                "TD": 7.59,
                                "CL": 199.18,
                                "CN": 5745.13,
                                "CO": 283.11,
                                "KM": 0.56,
                                "CD": 12.6,
                                "CG": 11.88,
                                "CR": 35.02,
                                "CI": 22.38,
                                "HR": 59.92,
                                "CY": 22.75,
                                "CZ": 195.23,
                                "DK": 304.56,
                                "DJ": 1.14,
                                "DM": 0.38,
                                "DO": 50.87,
                                "EC": 61.49,
                                "EG": 216.83,
                                "SV": 21.8,
                                "GQ": 14.55,
                                "ER": 2.25,
                                "EE": 19.22,
                                "ET": 30.94,
                                "FJ": 3.15,
                                "FI": 231.98,
                                "FR": 2555.44,
                                "GA": 12.56,
                                "GM": 1.04,
                                "GE": 11.23,
                                "DE": 3305.9,
                                "GH": 18.06,
                                "GR": 305.01,
                                "GD": 0.65,
                                "GT": 40.77,
                                "GN": 4.34,
                                "GW": 0.83,
                                "GY": 2.2,
                                "HT": 6.5,
                                "HN": 15.34,
                                "HK": 226.49,
                                "HU": 132.28,
                                "IS": 12.77,
                                "IN": 15000.02,
                                "ID": 695.06,
                                "IR": 337.9,
                                "IQ": 84.14,
                                "IE": 204.14,
                                "IL": 201.25,
                                "IT": 2036.69,
                                "JM": 13.74,
                                "JP": 5390.9,
                                "JO": 27.13,
                                "KZ": 129.76,
                                "KE": 32.42,
                                "KI": 0.15,
                                "KR": 986.26,
                                "KW": 117.32,
                                "KG": 4.44,
                                "LA": 6.34,
                                "LV": 23.39,
                                "LB": 39.15,
                                "LS": 1.8,
                                "LR": 0.98,
                                "LY": 77.91,
                                "LT": 35.73,
                                "LU": 52.43,
                                "MK": 9.58,
                                "MG": 8.33,
                                "MW": 5.04,
                                "MY": 218.95,
                                "MV": 1.43,
                                "ML": 9.08,
                                "MT": 7.8,
                                "MR": 3.49,
                                "MU": 9.43,
                                "MX": 1004.04,
                                "MD": 5.36,
                                "MN": 5.81,
                                "ME": 3.88,
                                "MA": 91.7,
                                "MZ": 10.21,
                                "MM": 35.65,
                                "NA": 11.45,
                                "NP": 15.11,
                                "NL": 770.31,
                                "NZ": 138,
                                "NI": 6.38,
                                "NE": 5.6,
                                "NG": 206.66,
                                "NO": 413.51,
                                "OM": 53.78,
                                "PK": 174.79,
                                "PA": 27.2,
                                "PG": 8.81,
                                "PY": 17.17,
                                "PE": 153.55,
                                "PH": 189.06,
                                "PL": 438.88,
                                "PT": 223.7,
                                "QA": 126.52,
                                "RO": 158.39,
                                "RU": 1476.91,
                                "RW": 5.69,
                                "WS": 0.55,
                                "ST": 0.19,
                                "SA": 434.44,
                                "SN": 12.66,
                                "RS": 38.92,
                                "SC": 0.92,
                                "SL": 1.9,
                                "SG": 217.38,
                                "SK": 86.26,
                                "SI": 46.44,
                                "SB": 0.67,
                                "ZA": 354.41,
                                "ES": 1374.78,
                                "LK": 48.24,
                                "KN": 0.56,
                                "LC": 1,
                                "VC": 0.58,
                                "SD": 65.93,
                                "SR": 3.3,
                                "SZ": 3.17,
                                "SE": 444.59,
                                "CH": 522.44,
                                "SY": 59.63,
                                "TW": 426.98,
                                "TJ": 5.58,
                                "TZ": 22.43,
                                "TH": 312.61,
                                "TL": 0.62,
                                "TG": 3.07,
                                "TO": 0.3,
                                "TT": 21.2,
                                "TN": 43.86,
                                "TR": 729.05,
                                "TM": 0,
                                "UG": 17.12,
                                "UA": 136.56,
                                "AE": 239.65,
                                "GB": 2258.57,
                                "US": 14624.18,
                                "UY": 40.71,
                                "UZ": 37.72,
                                "VU": 0.72,
                                "VE": 285.21,
                                "VN": 101.99,
                                "YE": 30.02,
                                "ZM": 15.69,
                                "ZW": 5.57
                            }
                        }]
                    },
                    onRegionTipShow: function(e, el, code) {
                        el.html(el.html()+' (Total Clicks : )');
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