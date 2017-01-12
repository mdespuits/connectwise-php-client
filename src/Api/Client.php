<?php

namespace Spinen\ConnectWise\Api;

use Exception;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use Spinen\ConnectWise\Support\Collection;

/**
 * Class Client
 *
 * @package Spinen\ConnectWise\Api
 *
 * @method array delete(string $resource, array $options = [])
 * @method array get(string $resource, array $options = [])
 * @method array head(string $resource, array $options = [])
 * @method array patch(string $resource, array $options = [])
 * @method array post(string $resource, array $options = [])
 * @method array put(string $resource, array $options = [])
 */
class Client
{
    /**
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * Headers that needs to be used with token
     *
     * @var array
     */
    protected $headers = [];

    /**
     * @var array
     */
    // TODO: Move this out to a dedicated class
    protected $resource_model_map = [
        '/company/companies'                                                          => 'Company\Company',
        '/company/companies/count'                                                    => 'Company\Company',
        '/company/companies/{id}'                                                     => 'Company\Company',
        '/company/companies/{id}/notes'                                               => 'Company\CompanyNote',
        '/company/companies/{id}/notes/count'                                         => 'Company\CompanyNote',
        '/company/companies/{id}/notes/{noteId}'                                      => 'Company\CompanyNote',
        '/company/companies/statuses'                                                 => 'Company\CompanyStatus',
        '/company/companies/statuses/count'                                           => 'Company\CompanyStatus',
        '/company/companies/statuses/{id}'                                            => 'Company\CompanyStatus',
        '/company/companies/{id}/teams'                                               => 'Company\CompanyTeam',
        '/company/companies/{id}/teams/count'                                         => 'Company\CompanyTeam',
        '/company/companies/{id}/teams/{teamId}'                                      => 'Company\CompanyTeam',
        '/company/companies/types'                                                    => 'Company\CompanyType',
        '/company/companies/types/count'                                              => 'Company\CompanyType',
        '/company/companies/types/{id}'                                               => 'Company\CompanyType',
        '/company/configurations'                                                     => 'Company\Configuration',
        '/company/configurations/count'                                               => 'Company\Configuration',
        '/company/configurations/{id}'                                                => 'Company\Configuration',
        '/company/configurations/statuses'                                            => 'Company\ConfigurationStatus',
        '/company/configurations/statuses/count'                                      => 'Company\ConfigurationStatus',
        '/company/configurations/statuses/{id}'                                       => 'Company\ConfigurationStatus',
        '/company/configurations/types/{id}/questions'                                => 'Company\ConfigurationTypeQuestion',
        '/company/configurations/types/{id}/questions/count'                          => 'Company\ConfigurationTypeQuestion',
        '/company/configurations/types/{id}/questions/{questionId}'                   => 'Company\ConfigurationTypeQuestion',
        '/company/configurations/types'                                               => 'Company\ConfigurationType',
        '/company/configurations/types/count'                                         => 'Company\ConfigurationType',
        '/company/configurations/types/{id}'                                          => 'Company\ConfigurationType',
        '/company/contacts/{id}/communications'                                       => 'Company\ContactCommunication',
        '/company/contacts/{id}/communications/count'                                 => 'Company\ContactCommunication',
        '/company/contacts/{id}/communications/{communicationId}'                     => 'Company\ContactCommunication',
        '/company/contacts/departments'                                               => 'Company\ContactDepartment',
        '/company/contacts/departments/count'                                         => 'Company\ContactDepartment',
        '/company/contacts/departments/{id}'                                          => 'Company\ContactDepartment',
        '/company/contacts/{id}/notes'                                                => 'Company\ContactNote',
        '/company/contacts/{id}/notes/count'                                          => 'Company\ContactNote',
        '/company/contacts/{id}/notes/{noteId}'                                       => 'Company\ContactNote',
        '/company/contacts/relationships'                                             => 'Company\ContactRelationship',
        '/company/contacts/relationships/count'                                       => 'Company\ContactRelationship',
        '/company/contacts/relationships/{id}'                                        => 'Company\ContactRelationship',
        '/company/contacts'                                                           => 'Company\Contact',
        '/company/contacts/count'                                                     => 'Company\Contact',
        '/company/contacts/{id}'                                                      => 'Company\Contact',
        '/company/contacts/{id}/portalSecurity'                                       => 'Company\Contact',
        '/company/contacts/{id}/image'                                                => 'Company\Contact',
        '/company/contacts/{id}/tracks'                                               => 'Company\ContactTrack',
        '/company/contacts/{id}/tracks/count'                                         => 'Company\ContactTrack',
        '/company/contacts/{id}/tracks/{trackId}'                                     => 'Company\ContactTrack',
        '/company/contacts/types'                                                     => 'Company\ContactType',
        '/company/contacts/types/count'                                               => 'Company\ContactType',
        '/company/contacts/types/{id}'                                                => 'Company\ContactType',
        '/company/companies/{id}/sites'                                               => 'Company\CompanySite',
        '/company/companies/{id}/sites/count'                                         => 'Company\CompanySite',
        '/company/companies/{id}/sites/{siteId}'                                      => 'Company\CompanySite',
        '/company/companies/{id}/managementSummaryReports'                            => 'Company\CompanyManagementSummaryReport',
        '/company/companies/{id}/managementSummaryReports/count'                      => 'Company\CompanyManagementSummaryReport',
        '/company/companies/{id}/managementSummaryReports/{reportId}'                 => 'Company\CompanyManagementSummaryReport',
        '/expense/entries'                                                            => 'Expense\ExpenseEntry',
        '/expense/entries/count'                                                      => 'Expense\ExpenseEntry',
        '/expense/entries/{id}'                                                       => 'Expense\ExpenseEntry',
        '/expense/types'                                                              => 'Expense\ExpenseType',
        '/expense/types/count'                                                        => 'Expense\ExpenseType',
        '/expense/types/{id}'                                                         => 'Expense\ExpenseType',
        '/finance/accounting/batches'                                                 => 'Finance\AccountingBatch',
        '/finance/accounting/batches/count'                                           => 'Finance\AccountingBatch',
        '/finance/accounting/batches/{id}'                                            => 'Finance\AccountingBatch',
        '/finance/agreements/{id}/additions'                                          => 'Finance\AgreementAddition',
        '/finance/agreements/{id}/additions/count'                                    => 'Finance\AgreementAddition',
        '/finance/agreements/{id}/additions/{additionId}'                             => 'Finance\AgreementAddition',
        '/finance/agreements/{id}/adjustments'                                        => 'Finance\AgreementAdjustment',
        '/finance/agreements/{id}/adjustments/count'                                  => 'Finance\AgreementAdjustment',
        '/finance/agreements/{id}/adjustments/{adjustmentId}'                         => 'Finance\AgreementAdjustment',
        '/finance/agreements'                                                         => 'Finance\Agreement',
        '/finance/agreements/count'                                                   => 'Finance\Agreement',
        '/finance/agreements/{id}'                                                    => 'Finance\Agreement',
        '/finance/agreements/{id}/configurations'                                     => 'Finance\Agreement',
        '/finance/agreements/{id}/configurations/count'                               => 'Finance\Agreement',
        '/finance/agreements/{id}/configurations/{configurationId}'                   => 'Finance\Agreement',
        '/finance/agreements/types'                                                   => 'Finance\AgreementType',
        '/finance/agreements/types/count'                                             => 'Finance\AgreementType',
        '/finance/agreements/types/{id}'                                              => 'Finance\AgreementType',
        '/finance/agreements/{id}/boardDefaults'                                      => 'Finance\AgreementBoardDefault',
        '/finance/agreements/{id}/boardDefaults/count'                                => 'Finance\AgreementBoardDefault',
        '/finance/agreements/{id}/boardDefaults/{boardDefaultId}'                     => 'Finance\AgreementBoardDefault',
        '/finance/agreements/{id}/sites'                                              => 'Finance\AgreementSite',
        '/finance/agreements/{id}/sites/count'                                        => 'Finance\AgreementSite',
        '/finance/agreements/{id}/sites/{siteId}'                                     => 'Finance\AgreementSite',
        '/finance/currencies'                                                         => 'Finance\Currency',
        '/finance/currencies/count'                                                   => 'Finance\Currency',
        '/finance/currencies/{id}'                                                    => 'Finance\Currency',
        '/finance/invoices'                                                           => 'Finance\Invoice',
        '/finance/invoices/count'                                                     => 'Finance\Invoice',
        '/finance/invoices/{id}'                                                      => 'Finance\Invoice',
        '/finance/invoices/{id}/pdf'                                                  => 'Finance\Invoice',
        '/finance/invoices/{id}/payments'                                             => 'Finance\InvoicePayment',
        '/finance/invoices/{id}/payments/{paymentId}'                                 => 'Finance\InvoicePayment',
        '/finance/accounting/batches/{id}/transactions'                               => 'Finance\AccountingBatchTransaction',
        '/finance/accounting/batches/{id}/transactions/count'                         => 'Finance\AccountingBatchTransaction',
        '/finance/accounting/batches/{id}/transactions/{transactionId}'               => 'Finance\AccountingBatchTransaction',
        '/finance/accounting/unpostedprocurement'                                     => 'Finance\AccountingUnpostedProcurement',
        '/finance/accounting/unpostedprocurement/count'                               => 'Finance\AccountingUnpostedProcurement',
        '/finance/accounting/unpostedprocurement/{id}'                                => 'Finance\AccountingUnpostedProcurement',
        '/finance/accounting/unpostedinvoices'                                        => 'Finance\AccountingUnpostedinvoice',
        '/finance/accounting/unpostedinvoices/count'                                  => 'Finance\AccountingUnpostedinvoice',
        '/finance/accounting/unpostedinvoices/{id}'                                   => 'Finance\AccountingUnpostedinvoice',
        '/finance/accounting/unpostedexpenses'                                        => 'Finance\AccountingUnpostedExpense',
        '/finance/accounting/unpostedexpenses/count'                                  => 'Finance\AccountingUnpostedExpense',
        '/finance/accounting/unpostedexpenses/{id}'                                   => 'Finance\AccountingUnpostedExpense',
        '/finance/agreements/{id}/workRoleExclusions'                                 => 'Finance\AgreementWorkRoleExclusion',
        '/finance/agreements/{id}/workRoleExclusions/count'                           => 'Finance\AgreementWorkRoleExclusion',
        '/finance/agreements/{id}/workroles'                                          => 'Finance\AgreementWorkRole',
        '/finance/agreements/{id}/workroles/count'                                    => 'Finance\AgreementWorkRole',
        '/finance/agreements/{id}/workroles/{workRoleId}'                             => 'Finance\AgreementWorkRole',
        '/finance/agreements/{id}/workTypeExclusions'                                 => 'Finance\AgreementWorkTypeExclusion',
        '/finance/agreements/{id}/workTypeExclusions/count'                           => 'Finance\AgreementWorkTypeExclusion',
        '/finance/agreements/{id}/worktypes'                                          => 'Finance\AgreementWorkType',
        '/finance/agreements/{id}/worktypes/count'                                    => 'Finance\AgreementWorkType',
        '/finance/agreements/{id}/worktypes/{worktypeId}'                             => 'Finance\AgreementWorkType',
        '/finance/taxCodes'                                                           => 'Finance\TaxCode',
        '/finance/taxCodes/count'                                                     => 'Finance\TaxCode',
        '/finance/taxCodes/{id}'                                                      => 'Finance\TaxCode',
        '/finance/taxCodes/{id}/taxCodeXRefs'                                         => 'Finance\TaxCodeXRef',
        '/finance/taxCodes/{id}/taxCodeXRefs/count'                                   => 'Finance\TaxCodeXRef',
        '/finance/taxCodes/{id}/taxCodeXRefs/{taxCodeXRefId}'                         => 'Finance\TaxCodeXRef',
        '/marketing/campaigns/{id}/audits'                                            => 'Marketing\CampaignAudit',
        '/marketing/campaigns/{id}/audits/count'                                      => 'Marketing\CampaignAudit',
        '/marketing/campaigns/{id}/audits/{auditId}'                                  => 'Marketing\CampaignAudit',
        '/marketing/campaigns'                                                        => 'Marketing\Campaign',
        '/marketing/campaigns/count'                                                  => 'Marketing\Campaign',
        '/marketing/campaigns/{id}'                                                   => 'Marketing\Campaign',
        '/marketing/campaigns/{id}/activities'                                        => 'Marketing\Campaign',
        '/marketing/campaigns/{id}/activities/count'                                  => 'Marketing\Campaign',
        '/marketing/campaigns/{id}/opportunities'                                     => 'Marketing\Campaign',
        '/marketing/campaigns/{id}/opportunities/count'                               => 'Marketing\Campaign',
        '/marketing/campaigns/statuses'                                               => 'Marketing\CampaignStatus',
        '/marketing/campaigns/statuses/count'                                         => 'Marketing\CampaignStatus',
        '/marketing/campaigns/statuses/{id}'                                          => 'Marketing\CampaignStatus',
        '/marketing/campaigns/types/{id}/subTypes'                                    => 'Marketing\CampaignSubType',
        '/marketing/campaigns/types/{id}/subTypes/count'                              => 'Marketing\CampaignSubType',
        '/marketing/campaigns/types/{id}/subTypes/{subTypeId}'                        => 'Marketing\CampaignSubType',
        '/marketing/campaigns/types'                                                  => 'Marketing\CampaignType',
        '/marketing/campaigns/types/count'                                            => 'Marketing\CampaignType',
        '/marketing/campaigns/types/{id}'                                             => 'Marketing\CampaignType',
        '/marketing/campaigns/{id}/emailsOpened'                                      => 'Marketing\CampaignEmailsOpened',
        '/marketing/campaigns/{id}/emailsOpened/count'                                => 'Marketing\CampaignEmailsOpened',
        '/marketing/campaigns/{id}/emailsOpened/{emailOpenedId}'                      => 'Marketing\CampaignEmailsOpened',
        '/marketing/campaigns/{id}/formsSubmitted'                                    => 'Marketing\CampaignFormsSubmitted',
        '/marketing/campaigns/{id}/formsSubmitted/count'                              => 'Marketing\CampaignFormsSubmitted',
        '/marketing/campaigns/{id}/formsSubmitted/{formSubmittedId}'                  => 'Marketing\CampaignFormsSubmitted',
        '/marketing/groups'                                                           => 'Marketing\Group',
        '/marketing/groups/count'                                                     => 'Marketing\Group',
        '/marketing/groups/{id}'                                                      => 'Marketing\Group',
        '/marketing/campaigns/{id}/linksClicked'                                      => 'Marketing\CampaignLinksClicked',
        '/marketing/campaigns/{id}/linksClicked/count'                                => 'Marketing\CampaignLinksClicked',
        '/marketing/campaigns/{id}/linksClicked/{linkClickedId}'                      => 'Marketing\CampaignLinksClicked',
        '/marketing/groups/{id}/companies'                                            => 'Marketing\GroupCompany',
        '/marketing/groups/{id}/companies/count'                                      => 'Marketing\GroupCompany',
        '/marketing/groups/{id}/companies/{companyId}'                                => 'Marketing\GroupCompany',
        '/marketing/groups/{id}/contacts'                                             => 'Marketing\GroupContact',
        '/marketing/groups/{id}/contacts/count'                                       => 'Marketing\GroupContact',
        '/marketing/groups/{id}/contacts/{contactId}'                                 => 'Marketing\GroupContact',
        '/procurement/adjustments/{id}/details'                                       => 'Procurement\AdjustmentDetail',
        '/procurement/adjustments/{id}/details/count'                                 => 'Procurement\AdjustmentDetail',
        '/procurement/adjustments/{id}/details/{detailId}'                            => 'Procurement\AdjustmentDetail',
        '/procurement/adjustments'                                                    => 'Procurement\Adjustment',
        '/procurement/adjustments/count'                                              => 'Procurement\Adjustment',
        '/procurement/adjustments/{id}'                                               => 'Procurement\Adjustment',
        '/procurement/adjustments/types'                                              => 'Procurement\AdjustmentType',
        '/procurement/adjustments/types/count'                                        => 'Procurement\AdjustmentType',
        '/procurement/adjustments/types/{id}'                                         => 'Procurement\AdjustmentType',
        '/procurement/catalog/{id}/components'                                        => 'Procurement\CatalogComponent',
        '/procurement/catalog/{id}/components/count'                                  => 'Procurement\CatalogComponent',
        '/procurement/catalog/{id}/components/{componentId}'                          => 'Procurement\CatalogComponent',
        '/procurement/catalog'                                                        => 'Procurement\CatalogsItem',
        '/procurement/catalog/count'                                                  => 'Procurement\CatalogsItem',
        '/procurement/catalog/{id}'                                                   => 'Procurement\CatalogsItem',
        '/procurement/catalog/{catalogItemIdentifier}/quantityOnHand'                 => 'Procurement\CatalogsItem',
        '/procurement/manufacturers'                                                  => 'Procurement\Manufacturer',
        '/procurement/manufacturers/count'                                            => 'Procurement\Manufacturer',
        '/procurement/manufacturers/{id}'                                             => 'Procurement\Manufacturer',
        '/procurement/categories'                                                     => 'Procurement\Category',
        '/procurement/categories/count'                                               => 'Procurement\Category',
        '/procurement/categories/{id}'                                                => 'Procurement\Category',
        '/procurement/pricingschedules/{schedId}/details/{detailId}/breaks'           => 'Procurement\PricingBreak',
        '/procurement/pricingschedules/{schedId}/details/{detailId}/breaks/count'     => 'Procurement\PricingBreak',
        '/procurement/pricingschedules/{schedId}/details/{detailId}/breaks/{breakId}' => 'Procurement\PricingBreak',
        '/procurement/pricingschedules/{id}/details'                                  => 'Procurement\PricingDetail',
        '/procurement/pricingschedules/{id}/details/count'                            => 'Procurement\PricingDetail',
        '/procurement/pricingschedules/{id}/details/{detailID}'                       => 'Procurement\PricingDetail',
        '/procurement/pricingschedules'                                               => 'Procurement\PricingSchedule',
        '/procurement/pricingschedules/count'                                         => 'Procurement\PricingSchedule',
        '/procurement/pricingschedules/{id}'                                          => 'Procurement\PricingSchedule',
        '/procurement/products/{id}/components'                                       => 'Procurement\ProductComponent',
        '/procurement/products/{id}/components/count'                                 => 'Procurement\ProductComponent',
        '/procurement/products/{id}/components/{componentId}'                         => 'Procurement\ProductComponent',
        '/procurement/products'                                                       => 'Procurement\ProductsItem',
        '/procurement/products/count'                                                 => 'Procurement\ProductsItem',
        '/procurement/products/{id}'                                                  => 'Procurement\ProductsItem',
        '/procurement/products/{id}/pickingShippingDetails'                           => 'Procurement\ProductPickingShippingDetail',
        '/procurement/products/{id}/pickingShippingDetails/count'                     => 'Procurement\ProductPickingShippingDetail',
        '/procurement/products/{id}/pickingShippingDetails/{pickingShippingDetailId}' => 'Procurement\ProductPickingShippingDetail',
        '/procurement/purchaseorders/{id}/lineitems'                                  => 'Procurement\PurchaseOrderLineItem',
        '/procurement/purchaseorders/{id}/lineitems/count'                            => 'Procurement\PurchaseOrderLineItem',
        '/procurement/purchaseorders/{id}/lineitems/{lineItemId}'                     => 'Procurement\PurchaseOrderLineItem',
        '/procurement/types'                                                          => 'Procurement\ProductType',
        '/procurement/types/count'                                                    => 'Procurement\ProductType',
        '/procurement/types/{id}'                                                     => 'Procurement\ProductType',
        '/procurement/purchaseorders'                                                 => 'Procurement\PurchaseOrder',
        '/procurement/purchaseorders/count'                                           => 'Procurement\PurchaseOrder',
        '/procurement/purchaseorders/{id}'                                            => 'Procurement\PurchaseOrder',
        '/procurement/shipmentmethods'                                                => 'Procurement\ShipmentMethod',
        '/procurement/shipmentmethods/count'                                          => 'Procurement\ShipmentMethod',
        '/procurement/shipmentmethods/{id}'                                           => 'Procurement\ShipmentMethod',
        '/procurement/categories/{id}/subcategories'                                  => 'Procurement\SubCategory',
        '/procurement/categories/{id}/subcategories/count'                            => 'Procurement\SubCategory',
        '/procurement/categories/{id}/subcategories/{subcategoryID}'                  => 'Procurement\SubCategory',
        '/procurement/unitOfMeasures/{id}/conversions'                                => 'Procurement\UnitOfMeasureConversion',
        '/procurement/unitOfMeasures/{id}/conversions/count'                          => 'Procurement\UnitOfMeasureConversion',
        '/procurement/unitOfMeasures/{id}/conversions/{conversionId}'                 => 'Procurement\UnitOfMeasureConversion',
        '/procurement/unitOfMeasures'                                                 => 'Procurement\UnitOfMeasure',
        '/procurement/unitOfMeasures/count'                                           => 'Procurement\UnitOfMeasure',
        '/procurement/unitOfMeasures/{id}'                                            => 'Procurement\UnitOfMeasure',
        '/project/projects/{id}/contacts'                                             => 'Project\ProjectContact',
        '/project/projects/{id}/contacts/{contactId}'                                 => 'Project\ProjectContact',
        '/project/projects/{id}/notes'                                                => 'Project\ProjectNote',
        '/project/projects/{id}/notes/count'                                          => 'Project\ProjectNote',
        '/project/projects/{id}/notes/{noteId}'                                       => 'Project\ProjectNote',
        '/project/projects/{id}/phases'                                               => 'Project\ProjectPhase',
        '/project/projects/{id}/phases/count'                                         => 'Project\ProjectPhase',
        '/project/projects/{id}/phases/{phaseId}'                                     => 'Project\ProjectPhase',
        '/project/projects'                                                           => 'Project\Project',
        '/project/projects/count'                                                     => 'Project\Project',
        '/project/projects/{id}'                                                      => 'Project\Project',
        '/project/projects/{id}/teamMembers'                                          => 'Project\ProjectsTeamMember',
        '/project/projects/{id}/teamMembers/count'                                    => 'Project\ProjectsTeamMember',
        '/project/projects/{id}/teamMembers/{teamMemberId}'                           => 'Project\ProjectsTeamMember',
        '/sales/activities'                                                           => 'Sales\Activity',
        '/sales/activities/count'                                                     => 'Sales\Activity',
        '/sales/activities/{id}'                                                      => 'Sales\Activity',
        '/sales/activities/statuses'                                                  => 'Sales\ActivityStatus',
        '/sales/activities/statuses/count'                                            => 'Sales\ActivityStatus',
        '/sales/activities/statuses/{id}'                                             => 'Sales\ActivityStatus',
        '/sales/activities/types'                                                     => 'Sales\ActivityType',
        '/sales/activities/types/count'                                               => 'Sales\ActivityType',
        '/sales/activities/types/{id}'                                                => 'Sales\ActivityType',
        '/sales/opportunities/{id}/forecast'                                          => 'Sales\OpportunityForecast',
        '/sales/opportunities/{id}/forecast/count'                                    => 'Sales\OpportunityForecast',
        '/sales/opportunities/{id}/forecast/{forecastId}'                             => 'Sales\OpportunityForecast',
        '/sales/opportunities'                                                        => 'Sales\Opportunity',
        '/sales/opportunities/count'                                                  => 'Sales\Opportunity',
        '/sales/opportunities/{id}'                                                   => 'Sales\Opportunity',
        '/sales/opportunities/{id}/contacts'                                          => 'Sales\OpportunityContact',
        '/sales/opportunities/{id}/contacts/count'                                    => 'Sales\OpportunityContact',
        '/sales/opportunities/{id}/contacts/{contactId}'                              => 'Sales\OpportunityContact',
        '/sales/opportunities/{id}/notes'                                             => 'Sales\OpportunityNote',
        '/sales/opportunities/{id}/notes/count'                                       => 'Sales\OpportunityNote',
        '/sales/opportunities/{id}/notes/{noteId}'                                    => 'Sales\OpportunityNote',
        '/sales/opportunities/ratings'                                                => 'Sales\OpportunityRating',
        '/sales/opportunities/ratings/count'                                          => 'Sales\OpportunityRating',
        '/sales/opportunities/ratings/{id}'                                           => 'Sales\OpportunityRating',
        '/sales/opportunities/statuses'                                               => 'Sales\OpportunityStatus',
        '/sales/opportunities/statuses/count'                                         => 'Sales\OpportunityStatus',
        '/sales/opportunities/statuses/{id}'                                          => 'Sales\OpportunityStatus',
        '/sales/opportunities/types'                                                  => 'Sales\OpportunityType',
        '/sales/opportunities/types/count'                                            => 'Sales\OpportunityType',
        '/sales/opportunities/types/{id}'                                             => 'Sales\OpportunityType',
        '/sales/orders'                                                               => 'Sales\Order',
        '/sales/orders/count'                                                         => 'Sales\Order',
        '/sales/orders/{id}'                                                          => 'Sales\Order',
        '/sales/opportunities/{id}/team'                                              => 'Sales\OpportunityTeam',
        '/sales/opportunities/{id}/team/count'                                        => 'Sales\OpportunityTeam',
        '/sales/opportunities/{id}/team/{teamId}'                                     => 'Sales\OpportunityTeam',
        '/sales/orders/statuses'                                                      => 'Sales\OrderStatus',
        '/sales/orders/statuses/count'                                                => 'Sales\OrderStatus',
        '/sales/orders/statuses/{id}'                                                 => 'Sales\OrderStatus',
        '/schedule/entries'                                                           => 'Schedule\ScheduleEntry',
        '/schedule/entries/count'                                                     => 'Schedule\ScheduleEntry',
        '/schedule/entries/{id}'                                                      => 'Schedule\ScheduleEntry',
        '/schedule/statuses'                                                          => 'Schedule\ScheduleStatus',
        '/schedule/statuses/count'                                                    => 'Schedule\ScheduleStatus',
        '/schedule/statuses/{id}'                                                     => 'Schedule\ScheduleStatus',
        '/schedule/types'                                                             => 'Schedule\ScheduleType',
        '/schedule/types/count'                                                       => 'Schedule\ScheduleType',
        '/schedule/types/{id}'                                                        => 'Schedule\ScheduleType',
        '/service/boards'                                                             => 'Service\Board',
        '/service/boards/count'                                                       => 'Service\Board',
        '/service/boards/{id}'                                                        => 'Service\Board',
        '/service/codes'                                                              => 'Service\Code',
        '/service/codes/count'                                                        => 'Service\Code',
        '/service/codes/{id}'                                                         => 'Service\Code',
        '/service/boards/{id}/excludedMembers'                                        => 'Service\BoardExcludedMember',
        '/service/boards/{id}/excludedMembers/count'                                  => 'Service\BoardExcludedMember',
        '/service/boards/{id}/excludedMembers/{excludedMemberId}'                     => 'Service\BoardExcludedMember',
        '/service/boards/{id}/items'                                                  => 'Service\BoardItem',
        '/service/boards/{id}/items/count'                                            => 'Service\BoardItem',
        '/service/boards/{id}/items/{itemId}'                                         => 'Service\BoardItem',
        '/service/knowledgeBaseArticles'                                              => 'Service\KnowledgeBaseArticle',
        '/service/knowledgeBaseArticles/count'                                        => 'Service\KnowledgeBaseArticle',
        '/service/knowledgeBaseArticles/{id}'                                         => 'Service\KnowledgeBaseArticle',
        '/service/locations'                                                          => 'Service\Location',
        '/service/locations/count'                                                    => 'Service\Location',
        '/service/locations/{id}'                                                     => 'Service\Location',
        '/service/priorities'                                                         => 'Service\Priority',
        '/service/priorities/count'                                                   => 'Service\Priority',
        '/service/priorities/{id}'                                                    => 'Service\Priority',
        '/service/priorities/{id}/image'                                              => 'Service\Priority',
        '/service/tickets/{id}/notes'                                                 => 'Service\TicketNote',
        '/service/tickets/{id}/notes/count'                                           => 'Service\TicketNote',
        '/service/tickets/{id}/notes/{noteId}'                                        => 'Service\TicketNote',
        '/service/sources'                                                            => 'Service\Source',
        '/service/sources/count'                                                      => 'Service\Source',
        '/service/sources/{id}'                                                       => 'Service\Source',
        '/service/boards/{id}/statuses'                                               => 'Service\BoardStatus',
        '/service/boards/{id}/statuses/count'                                         => 'Service\BoardStatus',
        '/service/boards/{id}/statuses/{statusId}'                                    => 'Service\BoardStatus',
        '/service/boards/{id}/subtypes'                                               => 'Service\BoardSubType',
        '/service/boards/{id}/subtypes/count'                                         => 'Service\BoardSubType',
        '/service/boards/{id}/subtypes/{subtypeId}'                                   => 'Service\BoardSubType',
        '/service/surveys/{id}/questions'                                             => 'Service\SurveyQuestion',
        '/service/surveys/{id}/questions/count'                                       => 'Service\SurveyQuestion',
        '/service/surveys/{id}/questions/{questionId}'                                => 'Service\SurveyQuestion',
        '/service/surveys/{id}/results'                                               => 'Service\SurveyResult',
        '/service/surveys/{id}/results/count'                                         => 'Service\SurveyResult',
        '/service/surveys/{id}/results/{resultId}'                                    => 'Service\SurveyResult',
        '/service/surveys'                                                            => 'Service\Survey',
        '/service/surveys/count'                                                      => 'Service\Survey',
        '/service/surveys/{id}'                                                       => 'Service\Survey',
        '/service/tickets/{id}/tasks'                                                 => 'Service\TicketTask',
        '/service/tickets/{id}/tasks/count'                                           => 'Service\TicketTask',
        '/service/tickets/{id}/tasks/{taskId}'                                        => 'Service\TicketTask',
        '/service/boards/{id}/teams'                                                  => 'Service\BoardTeam',
        '/service/boards/{id}/teams/count'                                            => 'Service\BoardTeam',
        '/service/boards/{id}/teams/{teamId}'                                         => 'Service\BoardTeam',
        '/service/tickets'                                                            => 'Service\Ticket',
        '/service/tickets/count'                                                      => 'Service\Ticket',
        '/service/tickets/{id}'                                                       => 'Service\Ticket',
        '/service/tickets/{id}/activities'                                            => 'Service\Ticket',
        '/service/tickets/{id}/activities/count'                                      => 'Service\Ticket',
        '/service/tickets/{id}/timeentries'                                           => 'Service\Ticket',
        '/service/tickets/{id}/timeentries/count'                                     => 'Service\Ticket',
        '/service/tickets/{id}/scheduleentries'                                       => 'Service\Ticket',
        '/service/tickets/{id}/scheduleentries/count'                                 => 'Service\Ticket',
        '/service/tickets/{id}/documents'                                             => 'Service\Ticket',
        '/service/tickets/{id}/documents/count'                                       => 'Service\Ticket',
        '/service/tickets/{id}/products'                                              => 'Service\Ticket',
        '/service/tickets/{id}/products/count'                                        => 'Service\Ticket',
        '/service/tickets/{id}/configurations'                                        => 'Service\Ticket',
        '/service/tickets/{id}/configurations/count'                                  => 'Service\Ticket',
        '/service/tickets/{id}/configurations/{configId}'                             => 'Service\Ticket',
        '/service/boards/{id}/types'                                                  => 'Service\BoardType',
        '/service/boards/{id}/types/count'                                            => 'Service\BoardType',
        '/service/boards/{id}/types/{typeId}'                                         => 'Service\BoardType',
        '/service/boards/{id}/types/{typeId}/subTypeAssociation'                      => 'Service\BoardType',
        '/system/audittrail'                                                          => 'System\AuditTrail',
        '/system/audittrail/count'                                                    => 'System\AuditTrail',
        '/system/callbacks'                                                           => 'System\Callback',
        '/system/callbacks/count'                                                     => 'System\Callback',
        '/system/callbacks/{id}'                                                      => 'System\Callback',
        '/system/connectwisehostedsetups'                                             => 'System\ConnectWiseHostedSetup',
        '/system/connectwisehostedsetups/count'                                       => 'System\ConnectWiseHostedSetup',
        '/system/connectwisehostedsetups/{id}'                                        => 'System\ConnectWiseHostedSetup',
        '/system/documents'                                                           => 'System\Document',
        '/system/documents/count'                                                     => 'System\Document',
        '/system/documents/{id}'                                                      => 'System\Document',
        '/system/documents/{id}/download'                                             => 'System\Document',
        '/system/documents/uploadsample'                                              => 'System\Document',
        '/system/info'                                                                => 'System\Info',
        '/system/links'                                                               => 'System\Link',
        '/system/links/count'                                                         => 'System\Link',
        '/system/links/{id}'                                                          => 'System\Link',
        '/system/members'                                                             => 'System\Member',
        '/system/members/count'                                                       => 'System\Member',
        '/system/members/{memberIdentifier}'                                          => 'System\Member',
        '/system/members/{memberIdentifier}/image'                                    => 'System\Member',
        '/system/menuentries'                                                         => 'System\MenuEntry',
        '/system/menuentries/count'                                                   => 'System\MenuEntry',
        '/system/menuentries/{id}'                                                    => 'System\MenuEntry',
        '/system/menuentries/{id}/image'                                              => 'System\MenuEntry',
        '/system/reports'                                                             => 'System\Report',
        '/system/reports/{reportName}'                                                => 'System\Report',
        '/system/reports/{reportName}/count'                                          => 'System\Report',
        '/system/reports/{reportName}/columns'                                        => 'System\Report',
        '/system/userDefinedFields'                                                   => 'System\UserDefinedField',
        '/system/userDefinedFields/count'                                             => 'System\UserDefinedField',
        '/system/userDefinedFields/{id}'                                              => 'System\UserDefinedField',
        '/time/activitystopwatches'                                                   => 'Time\ActivityStopwatch',
        '/time/activitystopwatches/count'                                             => 'Time\ActivityStopwatch',
        '/time/activitystopwatches/{id}'                                              => 'Time\ActivityStopwatch',
        '/time/schedulestopwatches'                                                   => 'Time\ScheduleStopwatch',
        '/time/schedulestopwatches/count'                                             => 'Time\ScheduleStopwatch',
        '/time/schedulestopwatches/{id}'                                              => 'Time\ScheduleStopwatch',
        '/time/ticketstopwatches'                                                     => 'Time\TicketStopwatch',
        '/time/ticketstopwatches/count'                                               => 'Time\TicketStopwatch',
        '/time/ticketstopwatches/{id}'                                                => 'Time\TicketStopwatch',
        '/time/entries'                                                               => 'Time\TimeEntry',
        '/time/entries/count'                                                         => 'Time\TimeEntry',
        '/time/entries/{id}'                                                          => 'Time\TimeEntry',
    ];

    /**
     * Integrator username to make global calls
     *
     * @var
     */
    protected $integrator;

    /**
     * Integration password for global calls
     *
     * @var
     */
    protected $password;

    /**
     * Public & private keys to log into CW
     *
     * @var Token
     */
    protected $token;

    /**
     * URL to the ConnectWise installation
     *
     * @var string
     */
    protected $url;

    /**
     * Supported verbs
     *
     * @var array
     */
    protected $verbs = [
        'delete',
        'get',
        'head',
        'put',
        'post',
        'patch',
    ];

    /**
     * Client constructor.
     *
     * @param Token  $token
     * @param Guzzle $guzzle
     */
    public function __construct(Token $token, Guzzle $guzzle)
    {
        $this->token = $token;
        $this->guzzle = $guzzle;
    }

    /**
     * Magic method to allow short cut to the request types
     *
     * @param string $verb
     * @param array  $args
     *
     * @return array
     */
    public function __call($verb, $args)
    {
        if (count($args) < 1) {
            throw new InvalidArgumentException('Magic request methods require a resource and optional options array');
        }

        if (!in_array($verb, $this->verbs)) {
            throw new InvalidArgumentException(sprintf("Unsupported verb [%s] was requested.", $verb));
        }

        return $this->request($verb, $args[0], $args[1] ?? []);
    }

    /**
     * Adds key/value pair to the header to be sent
     *
     * @param array $header
     *
     * @return $this
     */
    public function addHeader(array $header)
    {
        foreach ($header as $key => $value) {
            $this->headers[$key] = $value;
        }

        return $this;
    }

    /**
     * Build authorization headers to send CW API
     *
     * @return array
     */
    public function buildAuth()
    {
        if ($this->token->needsRefreshing()) {
            $this->token->refresh($this);
        }

        return [
            $this->token->getUsername(),
            $this->token->getPassword(),
        ];
    }

    /**
     * Build the options to send to API
     *
     * We allays need to login with Basic Auth, so add the "auth" option for Guzzle to use when logging in.
     * Additionally, pass any headers that have been set.
     *
     * @param array $options
     *
     * @return array
     */
    public function buildOptions(array $options = [])
    {
        return array_merge_recursive($options, [
            'auth'    => $this->buildAuth(),
            'headers' => $this->getHeaders(),
        ]);
    }

    /**
     * Build the full path to the CW resource
     *
     * @param string $resource
     *
     * @return string
     */
    public function buildUri($resource)
    {
        return $this->url . '/v4_6_release/apis/3.0/' . ltrim($resource, '/');
    }

    /**
     * Remove all set headers
     *
     * @return $this
     */
    public function emptyHeaders()
    {
        $this->setHeaders([]);

        return $this;
    }

    /**
     * Find the model to fill with the results from the request
     *
     * This is a little more complicated than you would think that it needs to be, but we have to map the response to
     * a model by looking at the URI.  If the URI is for a specific id, then the id has to be converted to the wildcard
     * in the map or it is a single resource & not a collection, then the id has to be removed from the end.
     *
     * @param string $uri
     *
     * @return string|null
     */
    public function findResourceModel($uri)
    {
        // Pull leading slash off
        $uri = ltrim($uri, '/');

        // Bust the resource into the parts
        $uri_parts = parse_url($uri);

        // Trim /\\d+ off the end
        $pattern = preg_replace('|/\\d+$|u', '', $uri_parts['path']);

        // Replace /\\d+/ with /{id}}/
        $pattern = preg_replace('|/\\d+/|u', '/{id}/', $pattern);

        // Make regex
        $pattern = '|^/?' . $pattern . '/?\\d*?$|ui';

        // This is convoluted, but it is getting the first value of the filtered resources that the key matches the
        // associative array
        // TODO: Consider flipping the resource map array to put the resources second to clean this up?
        try {
            return array_values(array_intersect_key($this->resource_model_map,
                array_flip(preg_grep($pattern, array_keys($this->resource_model_map)))))[0];
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * The headers to send
     *
     * When making an integrator call (expired token), then you have to only send the "x-cw-usertype" header.
     *
     * @return array
     */
    public function getHeaders()
    {
        if ($this->token->isForUser($this->integrator)) {
            return [
                'x-cw-usertype' => 'integrator',
            ];
        }

        return $this->headers;
    }

    /**
     * Expose the integrator username
     *
     * @return string
     */
    public function getIntegrator()
    {
        return $this->integrator;
    }

    /**
     * Expose the integrator password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Process the error received from ConnectWise
     *
     * @param RequestException $exception
     */
    // TODO: Figure out what to really do with an error...
    /**
     * @param RequestException $exception
     */
    protected function processError(RequestException $exception)
    {
        echo Psr7\str($exception->getRequest());

        if ($exception->hasResponse()) {
            echo Psr7\str($exception->getResponse());
        }
    }

    /**
     * @param          $resource
     * @param Response $response
     *
     * @return array|Response
     */
    protected function processResponse($resource, Response $response)
    {
        $response = (array)json_decode($response->getBody(), true);

        if ($model = $this->findResourceModel($resource)) {
            $model = 'Spinen\ConnectWise\Models\\' . $model;

            if ($this->isCollection($response)) {
                $response = array_map(function ($item) use ($model) {
                    $item = new $model($item);

                    return $item;
                }, $response);

                return new Collection($response);
            }

            return new $model($response);
        }

        return $response;
    }

    /**
     * Make call to the resource
     *
     * @param string     $method
     * @param string     $resource
     * @param array|null $options
     *
     * @return array
     */
    protected function request($method, $resource, array $options = [])
    {
        try {
            $response = $this->guzzle->request($method, $this->buildUri($resource), $this->buildOptions($options));

            return $this->processResponse($resource, $response);
        } catch (RequestException $e) {
            $this->processError($e);
        }
    }

    /**
     * Set the headers
     *
     * There is an "addHeader" method to push a single header onto the stack.  Otherwise,this replaces the headers.
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Set the integrator username
     *
     * @param string $integrator
     *
     * @return $this
     */
    public function setIntegrator($integrator)
    {
        $this->integrator = $integrator;

        return $this;
    }

    /**
     * Set the integrator password
     *
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set the URL to ConnectWise
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(sprintf("The URL provided[%] is not a valid format.", $url));
        }

        $this->url = rtrim($url, '/');

        return $this;
    }

    protected function isCollection(array $array)
    {
        // Keys of the array
        $keys = array_keys($array);

        // If the array keys of the keys match the keys, then the array must
        // not be associative (e.g. the keys array looked like {0:0, 1:1...}).
        return array_keys($keys) === $keys;
    }
}
