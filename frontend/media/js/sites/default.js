$(document).ready(function() {

    function App() {
        var _self = this;
        var autoplay = false;
        var edit = false;

        this.init = function() {
            this.cacheElement();
            this.addEvent();

            this.resetButton.prop('disabled',true);
            this.saveButton.prop('disabled',true);
            this.loadButton.prop('disabled',true);

            this.patterns.trigger('change');
        },
        this.cacheElement = function() {
            this.board = $("#board");

            this.stepOne = $("#stepOne");
            this.autoPlayButton = $("#autoPlay");
            this.editButton = $("#editButton");
            this.loadButton = $("#loadButton");
            this.resetButton = $("#resetButton");
            this.saveButton = $("#saveButton");
            this.uploadButton = $("#uploadButton");
            this.patterns = $("#patterns");

            this.saveModal = $("#saveModal");
            this.saveForm = $("#save-Form");

            this.uploadModal = $("#uploadModal");
            this.uploadForm = $("#upload-Form");
        },
        this.addEvent = function() {
            this.stepOne.on('click',this.getNextStep);
            this.autoPlayButton.on('click',this.autoPlayClick);
            this.editButton.on('click',this.editButtonClick);
            this.board.on('click','td',this.tdClick);
            this.resetButton.on('click',this.resetButtonClick);
            this.saveButton.on('click',this.saveButtonClick);
            this.loadButton.on('click',this.loadButtonClick);
            this.uploadButton.on('click',this.uploadButtonClick);

            this.saveForm.on('submit',this.saveFormSubmit);
            this.uploadForm.on('submit',this.uploadFormSubmit);
            this.patterns.on('change',this.patternsChange);
        },
        this.getNextStep = function() {
            _self.sendData().then(function (alives) {
                _self.updateBoard(alives);
            });
        },
        this.sendData = function () {
            return new Promise(function (resolve, reject){
                $.ajax({
                    url: ROOT + jsRouter.get('mainAjax',{actiontarget: 'gol',maintarget: 'getNextStep'}),
                    type: 'post',
                    dataType: 'json',
                    data: _self.getPostData(),
                    success: function(data) {
                        if (data.error == false) {
                            resolve(data.alives);
                        }
                    }
                });
            })
        },
        this.getPostData = function () {
            var post = [];
            post.push({name: 'board[width]',value: _self.board.data('width')});
            post.push({name: 'board[height]',value: _self.board.data('height')});
            post.push({name: 'list',value: _self.patterns.val()});

            _self.board.find('td.active').each(function () {
                post.push({name: 'alives[]',value: $(this).attr('id')})
            });

            return post;
        },
        this.updateBoard = function (alives) {
            _self.board.find('td.active').removeClass('active');
            $.each(alives,function (index, value) {
                _self.board.find('td#'+value).addClass('active');
            });
        },
        this.bip = function () {
            setTimeout(function () {
                if (autoplay) {
                    _self.getNextStep();
                    _self.bip();
                }
            },1000);
        }

        this.autoPlayClick = function () {
            if (autoplay) {
                autoplay = false;
                _self.autoPlayButton.text('Start');
            } else {
                autoplay = true;
                _self.autoPlayButton.text('Stop');

                _self.bip();
            }

        },
        this.editButtonClick = function () {
            if (edit) {
                edit = false;

                _self.editButton.text('Edit on');
                _self.toggleButtons(false);
                _self.board.removeClass('edit');
                _self.resetButton.prop('disabled',true);
                _self.saveButton.prop('disabled',true);

            } else {
                edit = true;

                _self.editButton.text('Edit off');
                _self.toggleButtons(true);
                _self.board.addClass('edit');
                _self.resetButton.prop('disabled',false);
                _self.saveButton.prop('disabled',false);
            }
        },
        this.toggleButtons = function (state) {
            _self.stepOne.prop('disabled',state);
            _self.autoPlayButton.prop('disabled',state);
            _self.loadButton.prop('disabled',state);
        },
        this.tdClick = function () {
            if (edit) {
                $(this).toggleClass('active','');
            }
        },
        this.resetButtonClick = function () {
            _self.board.find('.active').removeClass('active');
        },
        this.saveButtonClick = function () {
            _self.saveModal.modal();
        },
        this.saveFormSubmit = function () {

            $(this).ajaxSubmit({
                type: 'post',
                dataType: 'json',
                data: _self.getPostData(),
                success: function (data) {
                    if (data.error == false) {
                        var option = _self.patterns.find('option[value="'+data.id+'"]');
                        if (option.length) {
                            option.text(data.name);
                        } else {
                            var option = "<option value='"+data.id+"'>"+data.name+"</option>";
                            _self.patterns.append(option);
                        }
                        _self.saveModal.modal('hide');
                    }
                }
            });

            return false;
        },
        this.patternsChange = function () {
            if ($(this).val() == -1) {
                _self.loadButton.prop('disabled',true);
            } else {
                _self.loadButton.prop('disabled',false);
            }
        },
        this.loadButtonClick = function () {

            if ( _self.patterns.val() == -1) return false;

            $.ajax({
                url: ROOT + jsRouter.get('mainAjax',{actiontarget: 'gol',maintarget: 'load'}),
                type: 'post',
                dataType: 'json',
                data: {
                    id: _self.patterns.val()
                },
                success: function(data) {
                    if (data.error == false) {
                        _self.buildBoard(data);
                    }
                }
            });   
        },
        this.buildBoard = function (data) {
            _self.board.empty();
            _self.board.append(twig({ref: 'td-template'}).render({
                width: data.board.width,
                height: data.board.height,
                lives: data.alives
            }));
            _self.board.data('width',data.board.width);
            _self.board.data('height',data.board.height);
        },
        this.uploadButtonClick = function () {
            _self.uploadModal.modal();
        },
        this.uploadFormSubmit = function () {
            
            $(this).ajaxSubmit({
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.error == false) {
                        var option = _self.patterns.find('option[value="'+data.id+'"]');
                        if (option.length) {
                            option.text(data.name);
                        } else {
                            var option = "<option value='"+data.id+"'>"+data.name+"</option>";
                            _self.patterns.append(option);
                        }

                        _self.uploadModal.modal('hide');
                    }
                }
            })
            
            return false;   
        }
    }

    var app = new App();
    app.init();

});