/**
 * User: Tibor
 * Date: 2014.03.20.
 * Time: 19:49
 * Project: d2cadmin3.3
 * Company: d2c
 */
function ListView(target)
{
    var _self = this;

    this.initUrl = "";

    this.init = function() {
        getInitData();
    }


    function getInitData() {
        $.ajax({
            url: _self.initUrl,
            type: 'post',
            dataType: 'json',
            success: function(data) {
                initDatatables(data);
            }
        })
    }

    function createDefaultInit(data)
    {
        var config = {}

        if (data.renderMode == 'ajax') {
            config['fnServerParams'] = function ( aoData ) {
                //aoData.push( { "name": "more_data", "value": "my_value" } );
            };

            config['fnFooterCallback'] = function( nFoot, aData, iStart, iEnd, aiDisplay ) {
                //console.log(nFoot,aData);
                var checkbox = "<th><input type='checkbox'></th>"
                $("th:first",$(nFoot)).before(checkbox);

                var rowMenu = "<th>Actions</th>";
                $("th:last",$(nFoot)).after(rowMenu);
            }

            config['fnHeaderCallback'] = function( nHead, aData, iStart, iEnd, aiDisplay ) {
                //console.log(nHead,aData);
                var checkbox = "<th><input type='checkbox'></th>"
                $("th:first",$(nHead)).before(checkbox);

                var rowMenu = "<th>Actions</th>";
                $("th:last",$(nHead)).after(rowMenu);
            }

            config['fnRowCallback'] = function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                //console.log(nRow, aData, iDisplayIndex, iDisplayIndexFull);
                var checkbox = "<td><input type='checkbox'></td>"
                $("td:first",$(nRow)).before(checkbox);

                var rowMenu = "<td class='component'>"+ createActionMenu() +"</td>";
                $("td:last",$(nRow)).after(rowMenu);
            }

        }

        return config;
    }

    function createActionMenu()
    {
        var row = '<span class="cn-button">Menu</span>';
        row+= '<div class="cn-wrapper" id="cn-wrapper">';
        row+='<ul>';
        row+='<li><a href="#"><span>About</span></a></li>';
        row+='<li><a href="#"><span>Tutorials</span></a></li>';
        row+='<li><a href="#"><span>Articles</span></a></li>';
        row+='<li><a href="#"><span>Snippets</span></a></li>';
        row+='<li><a href="#"><span>Plugins</span></a></li>';
        row+='<li><a href="#"><span>Contact</span></a></li>';
        row+='<li><a href="#"><span>Follow</span></a></li>';
        row+='</ul>';
        row+='</div>';

        return row;
    }

    function initActionMenuEvent()
    {
        wrapper = $('.cn-wrapper');

        //open and close menu when the button is clicked
         $('body').on('click','.cn-button', handler);

        function handler(){

          if(!$(this).next().hasClass("opened-nav")){
            $(this).text("Close");
            $(this).next().addClass('opened-nav');
          }
          else{
            $(this).text("Menu");
            $(this).next().removeClass('opened-nav');
          }

          return false;
        }
    }

    function initDatatables(data)
    {
        var config = $.extend(createDefaultInit(data),data.config);

        $('#'+data.target).dataTable(config);

        initActionMenuEvent();
    }



}