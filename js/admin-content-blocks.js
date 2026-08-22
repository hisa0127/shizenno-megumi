/**
 * 投稿編集画面の SCF「content_blocks」繰り返しフィールドで、
 * block_type（ブロックの種類）の選択に応じて、関係ないサブフィールドを隠す。
 *
 * SCFの繰り返しフィールドは選んだ種類に関わらず全サブフィールドが常に表示されるため、
 * このスクリプトで「今の選択に関係する項目だけ」を表示するようにしている。
 * データの保存項目自体は変更していない（表示/非表示の切り替えのみ）。
 */
( function ( $ ) {
	'use strict';

	// block_type ごとに表示するサブフィールド名
	var FIELD_VISIBILITY = {
		heading: [ 'heading_level', 'heading_text' ],
		text: [ 'body_text', 'image' ],
		list: [ 'list_items' ]
	};

	// 切り替え対象になっている全サブフィールド名
	var TOGGLE_FIELDS = [ 'heading_level', 'heading_text', 'body_text', 'image', 'list_items' ];

	/**
	 * 行（1ブロック分）の中から、指定フィールド名の入力欄を包む
	 * table.smart-cf-field-type-* 要素を探す。
	 */
	function findFieldWrapper( $row, fieldName ) {
		var $control = $row.find( '[name*="[' + fieldName + ']"]' ).first();
		return $control.closest( 'table' );
	}

	/**
	 * block_type セレクトの現在値に応じて、同じ行のサブフィールドの表示/非表示を切り替える。
	 */
	function applyVisibility( $select ) {
		var $row = $select.closest( '.smart-cf-meta-box-table' );
		if ( ! $row.length ) {
			return;
		}

		var type = $select.val();
		var visibleFields = FIELD_VISIBILITY[ type ] || [];

		TOGGLE_FIELDS.forEach( function ( fieldName ) {
			var $wrapper = findFieldWrapper( $row, fieldName );
			if ( $wrapper.length ) {
				$wrapper.toggle( visibleFields.indexOf( fieldName ) !== -1 );
			}
		} );
	}

	/**
	 * 1行分（新規追加された行も含む）に初期状態を適用する。
	 */
	function initRow( $row ) {
		var $select = $row.find( 'select[name*="[block_type]"]' ).first();
		if ( $select.length ) {
			applyVisibility( $select );
		}
	}

	$( function () {
		// ページを開いた時点で存在する行（保存済みの記事）に初期状態を適用
		$( '.smart-cf-meta-box-table' ).each( function () {
			initRow( $( this ) );
		} );

		// block_type を切り替えたとき
		$( document ).on( 'change', 'select[name*="[block_type]"]', function () {
			applyVisibility( $( this ) );
		} );

		// 「＋」で新しいブロックが追加されたとき（SCFが発火するイベント）
		$( document ).on( 'smart-cf-after-add-group', function ( e, data ) {
			if ( data && data.clone ) {
				initRow( data.clone );
			}
		} );
	} );
} )( jQuery );
