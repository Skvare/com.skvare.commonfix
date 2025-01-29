  <?php

require_once 'commonfix.civix.php';
use CRM_Commonfix_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/ 
 */
function commonfix_civicrm_config(&$config) {
  _commonfix_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function commonfix_civicrm_install() {
  _commonfix_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function commonfix_civicrm_enable() {
  _commonfix_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *

 // */

/**
 * Implementation of hook_civicrm_buildForm
 */
function commonfix_civicrm_buildForm($formName, &$form) {
  // Changes for Stripe Extension.
  if (in_array($formName, ['CRM_Contribute_Form_Contribution_Main', 'CRM_Event_Form_Registration_Register'])) {
    // remove disable attribute on billing postal code
    CRM_Core_Region::instance('page-body')->add([
      'script' => "
          cj().ready(function () {
            show_billing_postal_code();
            cj('input[name=payment_processor_id]').click(function() {
              show_billing_postal_code();
            })
          });

          // Function to disable attribute on billing postal code
          function show_billing_postal_code() {
            setTimeout(function waitForField() {
              if (cj('#billing_postal_code-5').length > 0) {
                cj('#billing_postal_code-5').attr('disabled', false);
                cj('#billing_postal_code-5').attr('readonly', false);
              }
            }, 2500);
          }
        ",
    ]);
  }
}
