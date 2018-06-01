/**
 * JS in the theme.
 */
( function() {

    /**
	 * Add icon to sub menu items in the sidebar.
	 */
	var listItems1 = document.querySelectorAll( '.menu__items--sub-pages ul li a' );
	if ( listItems1 ) {
		for ( i = 0, len = listItems1.length; i < len; i++ ) {
			listItems1[i].insertAdjacentHTML( 'afterbegin', BemitText.icon );
		}
    }

} () );
