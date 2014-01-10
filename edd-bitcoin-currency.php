<?php
/**
 * Plugin Name: Easy Digital Downloads Bitcoin Currency
 * Plugin URI: http://claudiosmweb.com/
 * Description: Adds Bitcoin (BTC) currency in Easy Digital Downloads
 * Author: claudiosanches
 * Author URI: http://claudiosmweb.com/
 * Version: 1.0.0
 * License: GPLv2 or later
 * Text Domain: eddbitcc
 * Domain Path: /languages/
 */

/**
 * Add Bitcoin Currency in Easy Digital Downloads.
 */
class EDD_BTC_Currency {

	/**
	 * Class construct.
	 */
	public function __construct() {

		// Actions.
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 0 );

		// Filters.
		add_filter( 'edd_currencies', array( $this, 'add_currency' ) );
		add_filter( 'edd_btc_currency_filter_before', array( $this, 'currency_symbol' ) );
		add_filter( 'edd_btc_currency_filter_after', array( $this, 'currency_symbol' ) );
		add_filter( 'edd_format_amount_decimals', array( $this, 'currency_decimals' ) );
	}

	/**
	 * Load Plugin textdomain.
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'eddbitcc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Add Bitcoin currency.
	 *
	 * @param  array $currencies Default currencies.
	 *
	 * @return array             News currencies with Bitcoin.
	 */
	public function add_currency( $currencies ) {
		$currencies['BTC'] = __( 'Bitcoin (&#3647;)', 'eddbitcc' );
		asort( $currencies );

		return $currencies;
	}

	/**
	 * Fix Bitcoin currency symbol.
	 *
	 * @param  string $formated Formated currency display.
	 *
	 * @return string           Fixed Bitcoin currency display.
	 */
	public function currency_symbol( $formated ) {
		$currency_symbol = apply_filters( 'bitcoin_currency_symbol', '&#3647;' );

		$formated = str_replace( 'BTC', $currency_symbol, $formated );

		return $formated;
	}

	/**
	 * Fix decimals to Bitcoin.
	 *
	 * @return int           Bitcoin decimals.
	 */
	public function currency_decimals() {
		return 8;
	}
}

new EDD_BTC_Currency();
