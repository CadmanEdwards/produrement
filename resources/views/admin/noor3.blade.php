@extends('layouts.admin')
@section('content')


<style> .table123{
        float: left;
    margin-left: 30%;
    margin-top: 5%;
    }
    .main {
    margin-left: 5%;
}
.row.row2 {
    padding: 5px;
    margin-left:-12%;
    margin-bottom:-3%;
}
table.t2 {
    float: right;
}
.p2{
    float: right;
}
td {
    font-size: xx-small;
}
.fa-trash{
    color: red;
    float: left;
    font-size: 28px !important;
    margin-top: 5% !important;
    margin-left:-6%;
}
@media screen and (max-width: 600px){


    .card1{
        margin-left: 0  !important;
        width: 100% !important;
        margin-top: 10px  !important;
    }
    table.t2 {
    float: left !important;
}
.row.row1{


margin-top: 1% !important;
margin-bottom: 2px !important;
margin-right: 4px !important;

}
.img{
    width: 90% !important;
    height: 30px !important;
    margin-bottom: 4px;
    
}
.sm2{
    margin-bottom: 9px !important;
    margin-left: 24px !important;
}
.insm3{
    margin-left: 25%;
    font-size: 26px !important;
}
.row.row2{
    margin-right: 1% !important;
    margin-left: 1% !important;
}
.fa-trash{
    font-size: 29px !important;
    margin-top: 6% !important;
    margin-left: 35% !important;
}
.table6{
    margin-top: -1%;
    margin-left: -9%;

}
.imgcard{
    width: 50% !important;
    margin-left: 20% !important;
    margin-bottom: 5% !important;
}

}
.card {
    box-shadow: none !important;
}
</style>
<div class="main">
    <div class="container">

        <div class="row row1" style="margin-top: 1%; margin-bottom: 2px;">
            <div class="col-sm-12 cc">
              <div class="card card1" style="margin-left:7%; border-radius: 12px; width: 70%; ">
                <div class="card-body">
                  <div class="row rowcard1">
                      <div class="col-md-6">
                          
                          <table>
                            <tr><th>Adnan And Company</th></tr>

                            <tr>
                              <th>Company</th>
                              <th>Contact</th>
                              
                            </tr>
                            <tr>
                              <td>Alfreds Futterkiste   </td>
                              <td>Maria Anders</td>
                              
                            </tr>
                            <tr>
                              <td>Centro comercial Moctezuma  </td>
                              <td>Francisco Chang</td>
                              
                            </tr>
                            <tr>
                              <td>Ernst Handel  </td>
                              <td>Roland Mendel</td>
                              
                            </tr>
                            <tr>
                              <td>Island Trading  </td>
                              <td>Helen Bennett</td>
                              
                            </tr>
                            <tr>
                              <td>Laughing Bacchus Winecellars  </td>
                              <td>Yoshi Tannamuri</td>
                              
                            </tr>
                            <tr>
                              <td>Magazzini Alimentari Riuniti   </td>
                              <td>Giovanni Rovelli</td>
                              
                            </tr>
                          </table>


                      </div>
                      <div class="col-md-6" style="float: right;">
                        
                        <table class="t2">
                            <tr><th>Adnan And Company</th></tr>
                            <tr>
                              <th>Company</th>
                              <th>Contact</th>
                              
                            </tr>
                            <tr>
                              <td>Alfreds Futterkiste   </td>
                              <td>Maria Anders</td>
                              
                            </tr>
                            <tr>
                              <td>Centro comercial Moctezuma  </td>
                              <td>Francisco Chang</td>
                              
                            </tr>
                            <tr>
                              <td>Ernst Handel  </td>
                              <td>Roland Mendel</td>
                              
                            </tr>
                            <tr>
                              <td>Island Trading  </td>
                              <td>Helen Bennett</td>
                              
                            </tr>
                            <tr>
                              <td>Laughing Bacchus Winecellars  </td>
                              <td>Yoshi Tannamuri</td>
                              
                            </tr>
                            <tr>
                              <td>Magazzini Alimentari Riuniti   </td>
                              <td>Giovanni Rovelli</td>
                              
                            </tr>
                          </table>
                          
                      </div>

                  </div>
                </div>
              </div>
            </div>
            


            
        </div>



        <!---->

        <div class="row row2">
            <div class="col-sm-2 sm2">
              <div class="card imgcard" style="width: 50%;margin-left: 15%;">
                <div class="card-body" style="padding-bottom: 1px;
                padding-left: 10px;
                padding-top: 1px;
                padding-right: 2px !important;">
                  <img class="img" src="https://www.qries.com/images/banner_logo.png " style="width: 20px; height: 40px;" >
                  
                </div>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="card" style="    margin-left: -10%;
              width: 113%;
              margin-right: -4%;">
                <div class="card-body" style="padding-bottom: 1px;
                padding-top: 1px;">
                  <div class="row center-div">
                      <div class="col-sm-3 insm3">
                          <table>
                              <tr><th>Burger1</th></tr>
                                  <tr><td>detail of it</td></tr>
                              
                          </table>
                      </div>
                      <div class="col-sm-2 insm3">
                        <table>
                            <tr><th>Burger1</th></tr>
                                <tr><td>detail of it</td></tr>
                            
                        </table>
                      </div>
                      <div class="col-sm-2 insm3 ">
                        <table>
                            <tr><th>Burger1</th></tr>
                                <tr><td>detail of it</td></tr>
                            
                        </table>
                      </div>
                      <div class="col-sm-2 insm3">
                        <table>
                            <tr><th>Burger1</th></tr>
                                <tr><td>detail of it</td></tr>
                            
                        </table>
                      </div>
                      <div class="col-sm-2 insm3">
                        <table>
                            <tr><th>Burger1</th></tr>
                                <tr><td>detail of it</td></tr>
                            
                        </table>
                      </div>
                      <div class="col-sm-1 insm3">
                        <table>
                            <tr><th>price</th></tr>
                                <tr><td>detail</td></tr>
                            
                        </table>
                      </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-sm-2">
                <div class="card" style="border: none;">
                  <div class="card-body" style="padding-bottom: 1px;
                  padding-left: 10px;
                  padding-top: 1px;
                  padding-right: 2px !important;">
                    
                    <i class="fa fa-trash" style="float: left; font-size: 40px;"></i>
                </div>
              </div>
          </div>
          
    </div>
    <div class="row row2">
        <div class="col-sm-2">
          <div class="card imgcard" style="width: 50%;margin-left: 15%;">
            <div class="card-body" style="padding-bottom: 1px;
            padding-left: 10px;
            padding-top: 1px;
            padding-right: 2px !important;">
              <img class="img" src="https://www.qries.com/images/banner_logo.png " style="width: 20px; height: 40px;">
              
            </div>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="card" style="       margin-left: -10%;
              width: 113%;
              margin-right: -4%;;">
            <div class="card-body" style="padding-bottom: 1px;
            padding-top: 1px;">
              <div class="row center-div">
                  <div class="col-sm-3 insm3">
                      <table>
                          <tr><th>Burger1</th></tr>
                              <tr><td>detail of it</td></tr>
                          
                      </table>
                  </div>
                  <div class="col-sm-2 insm3">
                    <table>
                        <tr><th>Burger1</th></tr>
                            <tr><td>detail of it</td></tr>
                        
                    </table>
                  </div>
                  <div class="col-sm-2 insm3">
                    <table>
                        <tr><th>Burger1</th></tr>
                            <tr><td>detail of it</td></tr>
                        
                    </table>
                  </div>
                  <div class="col-sm-2 insm3">
                    <table>
                        <tr><th>Burger1</th></tr>
                            <tr><td>detail of it</td></tr>
                        
                    </table>
                  </div>
                  <div class="col-sm-2 insm3">
                    <table>
                        <tr><th>Burger1</th></tr>
                            <tr><td>detail of it</td></tr>
                        
                    </table>
                  </div>
                  <div class="col-sm-1 insm3">
                    <table>
                        <tr><th>price</th></tr>
                            <tr><td>detail</td></tr>
                        
                    </table>
                  </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col-sm-2">
            <div class="card" style="border: none;">
              <div class="card-body" style="padding-bottom: 1px;
              padding-left: 10px;
              padding-top: 1px;
              padding-right: 2px !important;">
                
                <i class="fa fa-trash" style="float: left; font-size: 40px;"></i>
            </div>
          </div>
      </div>
      
</div>
<div class="row row2">
    <div class="col-sm-2">
      <div class="card imgcard" style="width: 50%;margin-left: 15%;">
        <div class="card-body" style="padding-bottom: 1px;
        padding-left: 10px;
        padding-top: 1px;
        padding-right: 2px !important;">
          <img class="img" src="https://www.qries.com/images/banner_logo.png " style="width: 20px; height: 40px;">
          
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="card" style="      margin-left: -10%;
              width: 113%;
              margin-right: -4%;">
        <div class="card-body" style="padding-bottom: 1px;
        padding-top: 1px;">
          <div class="row center-div">
              <div class="col-sm-3 insm3">
                  <table>
                      <tr><th>Burger1</th></tr>
                          <tr><td>detail of it</td></tr>
                      
                  </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-1 insm3">
                <table>
                    <tr><th>price</th></tr>
                        <tr><td>detail</td></tr>
                    
                </table>
              </div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="col-sm-2 ">
        <div class="card" style="border: none;">
          <div class="card-body" style="padding-bottom: 1px;
          padding-left: 10px;
          padding-top: 1px;
          padding-right: 2px !important;">
            
            <i class="fa fa-trash" style="float: left; font-size: 40px;"></i>
        </div>
      </div>
  </div>
  
</div>
<div class="row row2">
    <div class="col-sm-2">
      <div class="card imgcard" style="width: 50%;margin-left: 15%;">
        <div class="card-body" style="padding-bottom: 1px;
        padding-left: 10px;
        padding-top: 1px;
        padding-right: 2px !important;">
          <img class="img" src="https://www.qries.com/images/banner_logo.png " style="width: 20px; height: 40px;">
          
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="card" style="    margin-left: -10%;
              width: 113%;
              margin-right: -4%;">
        <div class="card-body" style="padding-bottom: 1px;
        padding-top: 1px;">
          <div class="row center-div">
              <div class="col-sm-3 insm3">
                  <table>
                      <tr><th>Burger1</th></tr>
                          <tr><td>detail of it</td></tr>
                      
                  </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-1 insm3">
                <table>
                    <tr><th>price</th></tr>
                        <tr><td>detail</td></tr>
                    
                </table>
              </div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="col-sm-2">
        <div class="card" style="border: none;">
          <div class="card-body" style="padding-bottom: 1px;
          padding-left: 10px;
          padding-top: 1px;
          padding-right: 2px !important;">
            
            <i class="fa fa-trash" style="float: left; font-size: 40px;"></i>
        </div>
      </div>
  </div>
  
</div>
<div class="row row2">
    <div class="col-sm-2">
      <div class="card imgcard" style="width: 50%;margin-left: 15%;">
        <div class="card-body" style="padding-bottom: 1px;
        padding-left: 10px;
        padding-top: 1px;
        padding-right: 2px !important;">
          <img class="img" src="https://www.qries.com/images/banner_logo.png " style="width: 20px; height: 40px;">
          
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="card" style="    margin-left: -10%;
              width: 113%;
              margin-right: -4%;">
        <div class="card-body" style="padding-bottom: 1px;
        padding-top: 1px;">
          <div class="row center-div">
              <div class="col-sm-3 insm3">
                  <table>
                      <tr><th>Burger1</th></tr>
                          <tr><td>detail of it</td></tr>
                      
                  </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-2 insm3">
                <table>
                    <tr><th>Burger1</th></tr>
                        <tr><td>detail of it</td></tr>
                    
                </table>
              </div>
              <div class="col-sm-1 insm3">
                <table>
                    <tr><th>price</th></tr>
                        <tr><td>detail</td></tr>
                    
                </table>
              </div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="col-sm-2">
        <div class="card" style="border: none;">
          <div class="card-body" style="padding-bottom: 1px;
          padding-left: 10px;
          padding-top: 1px;
          padding-right: 2px !important;">
            
            <i class="fa fa-trash" style="float: left; font-size: 40px;"></i>
        </div>
      </div>
  </div>
  
</div>
<div class="row">

    <div class="col-md-6"></div>
    
    <div class="col-md-6 table6" >
        <table class="table123" style="float: left;" > 
           
              <tr>
                <td class="list" style="padding-right: 15px;">Alfreds Futterkiste   </td>
                <td>Maria Anders</td>
                
              </tr>
              
              <tr>
                <td class="list" style="padding-right: 15px;">Alfreds Futterkiste   </td>
                <td>Maria </td>
                
              </tr>
              
              <tr>
                <td class="list" style="padding-right: 15px;">Alfreds Futterkiste   </td>
                <td>Maria Anders</td>
                
              </tr>
              
              <tr>
                <td class="list" style="padding-right: 15px;">Alfreds Futterkiste   </td>
                <td>Maria </td>
                
              </tr>
              
              <tr>
                <td class="list" style="padding-right: 15px;">Alfreds Futterkiste   </td>
                <td>Maria Anders</td>
                
              </tr>
              
        </table>
    </div>
    
</div>
</div>

@endsection