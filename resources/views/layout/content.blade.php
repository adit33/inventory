 @extends('layout.master')

 @section('content')
 <section class="content-header">
          <h1>
            Dashboard
            <small>Version 2.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">CPU Traffic</span>
                  <span class="info-box-number">90<small>%</small></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">41,410</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Sales</span>
                  <span class="info-box-number">760</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number">2,000</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <!-- MAP & BOX PANE -->
              
              <div class="row">
                <div class="col-md-6">
                  <!-- DIRECT CHAT -->
                  <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title">Direct Chat</h3>
                      <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="3 New Messages" class='badge bg-yellow'>3</span>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <!-- Conversations are loaded here -->
                      <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                       
                          <!-- /.direct-chat-info -->
                          <!-- /.direct-chat-img -->
                          <div id="chat-log">
                      
                          </div><!-- /.direct-chat-text -->
                       

                        <!-- Message to the right -->
                        
                      </div><!--/.direct-chat-messages-->


                      <!-- Contacts are loaded here -->
                      <div class="direct-chat-contacts">
                        <ul class='contacts-list'>
                          <li>
                            <a href='#'>
                              <img class='contacts-list-img' src="{{asset('packages/admin/dist/img/user1-128x128.jpg')}}"/>
                              <div class='contacts-list-info'>
                                <span class='contacts-list-name'>
                                  Count Dracula
                                  <small class='contacts-list-date pull-right'>2/28/2015</small>
                                </span>
                                <span class='contacts-list-msg'>How have you been? I was...</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href='#'>
                              <img class='contacts-list-img' src='dist/img/user7-128x128.jpg'/>
                              <div class='contacts-list-info'>
                                <span class='contacts-list-name'>
                                  Sarah Doe
                                  <small class='contacts-list-date pull-right'>2/23/2015</small>
                                </span>
                                <span class='contacts-list-msg'>I will be waiting for...</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href='#'>
                              <img class='contacts-list-img' src='dist/img/user3-128x128.jpg'/>
                              <div class='contacts-list-info'>
                                <span class='contacts-list-name'>
                                  Nadia Jolie
                                  <small class='contacts-list-date pull-right'>2/20/2015</small>
                                </span>
                                <span class='contacts-list-msg'>I'll call you back at...</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href='#'>
                              <img class='contacts-list-img' src='dist/img/user5-128x128.jpg'/>
                              <div class='contacts-list-info'>
                                <span class='contacts-list-name'>
                                  Nora S. Vans
                                  <small class='contacts-list-date pull-right'>2/10/2015</small>
                                </span>
                                <span class='contacts-list-msg'>Where is your new...</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href='#'>
                              <img class='contacts-list-img' src='dist/img/user6-128x128.jpg'/>
                              <div class='contacts-list-info'>
                                <span class='contacts-list-name'>
                                  John K.
                                  <small class='contacts-list-date pull-right'>1/27/2015</small>
                                </span>
                                <span class='contacts-list-msg'>Can I take a look at...</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                          <li>
                            <a href='#'>
                              <img class='contacts-list-img' src='dist/img/user8-128x128.jpg'/>
                              <div class='contacts-list-info'>
                                <span class='contacts-list-name'>
                                  Kenneth M.
                                  <small class='contacts-list-date pull-right'>1/4/2015</small>
                                </span>
                                <span class='contacts-list-msg'>Never mind I found...</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                        </ul><!-- /.contatcts-list -->
                      </div><!-- /.direct-chat-pane -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      
                        <div class="input-group">
                          <input type="text" name="message" id="chat-message" placeholder="Type Message ..." class="form-control"/>
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-flat">Send</button>
                          </span>
                        </div>
                     
                    </div><!-- /.box-footer-->
                  </div><!--/.direct-chat -->
                </div><!-- /.col -->

                <div class="col-md-6">
                  <!-- USERS LIST -->
                    <!-- PRODUCT LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Recently Added Products</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <li class="item">
                      <div class="product-img">
                        <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title">Samsung TV <span class="label label-warning pull-right">$1800</span></a>
                        <span class="product-description">
                          Samsung 32" 1080p 60Hz LED Smart HDTV.
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title">Bicycle <span class="label label-info pull-right">$700</span></a>
                        <span class="product-description">
                          26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                        <span class="product-description">
                          Xbox One Console Bundle with Halo Master Chief Collection.
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title">PlayStation 4 <span class="label label-success pull-right">$399</span></a>
                        <span class="product-description">
                          PlayStation 4 500GB Console (PS4)
                        </span>
                      </div>
                    </li><!-- /.item -->
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript::;" class="uppercase">View All Products</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
                </div><!-- /.col -->
              </div><!-- /.row -->

              <!-- TABLE: LATEST ORDERS -->
            
            </div><!-- /.col -->

            <div class="col-md-4">
              <!-- Info Boxes Style 2 -->
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Inventory</span>
                  <span class="info-box-number">5,200</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description">
                    50% Increase in 30 Days
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Mentions</span>
                  <span class="info-box-number">92,050</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 20%"></div>
                  </div>
                  <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Downloads</span>
                  <span class="info-box-number">114,381</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Direct Messages</span>
                  <span class="info-box-number">163,921</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 40%"></div>
                  </div>
                  <span class="progress-description">
                    40% Increase in 30 Days
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
@stop

@section('asset-js')
 <script type="text/javascript" src="{{asset('packages/lib/brain-socket.min.js')}}" ></script>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('packages/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.2 JS -->
   <script>
    $(function(){
 
        // var fake_user_id = Math.floor((Math.random()*1000)+1);
        var fake_user_id = 'admin';
        //make sure to update the port number if your ws server is running on a different one.
        window.app = {};
 
        app.BrainSocket = new BrainSocket(
                new WebSocket('ws://127.0.0.1:8080'),
                new BrainSocketPubSub()
        );
 
        app.BrainSocket.Event.listen('generic.event',function(msg){
            console.log(msg);
            if(msg.client.data.user_id == fake_user_id){
              
                $('#chat-log').append(' <div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">Alexander Pierce</span><span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span></div><img class="direct-chat-img" src="{{asset('packages/admin/dist/img/avatar5.png')}}" alt="message user image" /><div class="direct-chat-text">'+msg.client.data.message+'</div></div>');
            }else{
                var str_test=' <div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">Alexander Pierce</span><span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span></div><img class="direct-chat-img" src="{{asset('packages/admin/dist/img/avatar04.png')}}" alt="message user image" /><div class="direct-chat-text">'+msg.client.data.message+'</div></div>';
                $('#chat-log').append(str_test);
            }
        });
 
        app.BrainSocket.Event.listen('app.success',function(data){
            console.log('An app success message was sent from the ws server!');
            console.log(data);
        });
 
        app.BrainSocket.Event.listen('app.error',function(data){
            console.log('An app error message was sent from the ws server!');
            console.log(data);
        });
 
        $('#chat-message').keypress(function(event) {
 
            if(event.keyCode == 13){
 
                app.BrainSocket.message('generic.event',
                        {
                            'message':$(this).val(),
                            'user_id':fake_user_id,
                            'user_portrait':''
                        }
                );
                $(this).val('');
 
            }
 
            return event.keyCode != 13; }
        );
    });
</script>
@stop