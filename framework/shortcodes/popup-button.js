(function() {
    tinymce.PluginManager.add('imaj_ekleme_butonu', function( editor, url ) {
        editor.addButton( 'imaj_ekleme_butonu', {
            icon: 'shortcodes-icon',
            type: 'menubutton',
            menu: [
                {
					text: 'Button',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Button',
							body: [
								{
									type: 'listbox',
									name: 'ButtonColor',
									label: 'Color',
									'values': [
										{text: 'Kırmızı', value: 'btn-danger'},
										{text: 'Turuncu', value: 'btn-warning'},
										{text: 'Yeşil', value: 'btn-success'},
										{text: 'Açık Mavi', value: 'btn-info'},
										{text: 'Koyu Mavi', value: 'btn-primary'},
									]
								},
								{
									type: 'listbox',
									name: 'ButtonSize',
									label: 'Size',
									'values': [
										{text: 'Small', value: 'btn-sm'},
										{text: 'Medium', value: ''},
										{text: 'Big', value: 'btn-lg'}
									]
								},
								{
									type: 'textbox',
									name: 'ButtonLink',
									label: 'Link',
									minWidth: 300,
									value: 'http://'
								},
								{
									type: 'textbox',
									name: 'ButtonText',
									label: 'Text',
									value: ''
								},
								{
									type: 'textbox',
									name: 'ButtonIcon',
									label: 'Icon (use full Font Awesome name):',
									value: ''
								},
								{
									type: 'checkbox',
									name: 'ButtonTarget',
									label: 'Open link in a new window/tab',
									value: 'blank',
								}

							],
							onsubmit: function( e ) {
								editor.insertContent( '[button color="' + e.data.ButtonColor + '" size="' + e.data.ButtonSize + '" link="' + e.data.ButtonLink + '" icon="' + e.data.ButtonIcon + '" target="' + e.data.ButtonTarget + '"]'+ e.data.ButtonText +'[/button]');
							}
						});
					}
				},
                {
					text: 'Kutu',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Kutu',
							body: [
								{
									type: 'listbox',
									name: 'alertType',
									label: 'Stil',
									'values': [
										{text: 'Bilgi', value: 'alert-info'},
										{text: 'Başarılı', value: 'alert-success'},
										{text: 'Hata', value: 'alert-warning'},
										{text: 'Tehlike', value: 'alert-danger'},
									]
								},
                                {
									type: 'textbox',
									name: 'alertText',
									label: 'İçerik',
                                    multiline: true,
									minWidth: 300,
									minHeight: 100,
									value: ''
								}

							],
							onsubmit: function( e ) {
								editor.insertContent( '[box type="' + e.data.alertType + '"]'+ e.data.alertText +'[/box]');
							}
						});
					}
				},
				{
					text: 'Vurgula (Highlight)',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Cümle Vurgulama',
							body: [
								{
									type: 'listbox',
									name: 'uck_highColor',
									label: 'Renk',
									'values': [
										{text: 'Kırmızı', value: 'kırmızı'},
										{text: 'Sarı', value: 'sarı'},
									]
								},
                                {
									type: 'textbox',
									name: 'uck_highText',
									label: 'İçerik',
                                    multiline: true,
									minWidth: 300,
									minHeight: 100,
									value: 'İçerik'
								}

							],
							onsubmit: function( e ) {
								editor.insertContent( '[vurgula renk="' + e.data.uck_highColor + '"]'+ e.data.uck_highText +'[/vurgula]');
							}
						});
					}
				},
				{
					text: 'Açılır Tab Menü (Toggle)',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Açılır Tab Menü',
							width: 350,
							height: 450,
							body: [
								{
									type: 'listbox',
									name: 'toggleType',
									label: 'Stil',
									'values': [
										{text: 'Dışa Doğru', value: 'popout'},
										{text: 'Normal', value: 'normal'},
									]
								},
								{
									type: 'textbox',
									name: 'bg_toggleTitle',
									label: 'Başlık',
									value: 'Başlık 1'
								},
								{
									type: 'textbox',
									name: 'bg_toggleContent',
									label: 'İçerik',
									minHeight: 75,
									value: 'İçerik 1'
								},
								{
									type: 'textbox',
									name: 'bg_toggleTitle1',
									label: 'Başlık',
									value: 'Başlık 2'
								},
								{
									type: 'textbox',
									name: 'bg_toggleContent1',
									label: 'İçerik',
									minHeight: 75,
									value: 'İçerik 2'
								},
								{
									type: 'textbox',
									name: 'bg_toggleTitle2',
									label: 'Başlık',
									value: 'Başlık 3'
								},
								{
									type: 'textbox',
									name: 'bg_toggleContent2',
									label: 'İçerik',
									minHeight: 75,
									value: 'İçerik 1'
								},
							],					

							onsubmit: function( e ) {
								editor.insertContent( '\
								[togglegroup type="'+ e.data.toggleType+'"]<br />\
									[toggle title="'+ e.data.bg_toggleTitle +'"] '+ e.data.bg_toggleContent +' [/toggle]<br />\
									[toggle title="'+ e.data.bg_toggleTitle1 +'"] '+ e.data.bg_toggleContent1 +' [/toggle]<br />\
									[toggle title="'+ e.data.bg_toggleTitle2 +'"] '+ e.data.bg_toggleContent2 +' [/toggle]<br />\
								[/togglegroup]');
							}
						},
						{
        					plugin_url : url
						});
					}
				},	

                {
					text: 'Google Harita',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Google Harita',
							body: [
								{
									type: 'textbox',
									name: 'mapLink',
									label: 'Link',
									minWidth: 300,
									value: 'http://'
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '[googlemap src="'+ e.data.mapLink +'"]');
							}
						});
					}
				},
				{
					text: 'Benzer Yazı',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Benzer Yazı',
							width: 350,
							height: 180,
							body: [
								{
									type: 'textbox',
									name: 'postID',
									label: 'Post ID',
									minWidth: 75,
									value: 'Post ID GIRIN'
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[recent-post id="'+ e.data.postID +'"]');
							}
						});
					}
				},
				{
					text: 'İlgili Yazılar',
					onclick: function() {
						editor.windowManager.open( {
							title: 'İlgili Yazılar',
							width: 350,
							height: 180,
							body: [
								{
									type: 'textbox',
									name: 'title',
									label: 'Başlık',
									minWidth: 75,
									value: ''
								},
								{
									type: 'textbox',
									name: 'tagID',
									label: 'TAG ID',
									minWidth: 75,
									value: 'TAG ID GIRIN'
								},
								{
									type: 'textbox',
									name: 'posts',
									label: 'Yazı Sayısı',
									minWidth: 75,
									value: ''
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[recent-posts title="'+ e.data.title +'" posts="'+ e.data.posts +'" tags="'+ e.data.tagID +'"]');
							}
						});
					}
				}
            ]
        });
    });
})();