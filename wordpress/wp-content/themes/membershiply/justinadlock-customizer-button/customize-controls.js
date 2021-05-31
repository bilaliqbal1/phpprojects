( function( api ) {

	// Extends our custom "membershiply" section.
	api.sectionConstructor['membershiply'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
