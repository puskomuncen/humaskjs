<?php

namespace PHPMaker2025\humaskerjasama;

use DI\ContainerBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Result;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Cache\QueryCacheProfile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Dflydev\FigCookies\FigRequestCookies;
use Dflydev\FigCookies\FigResponseCookies;
use Dflydev\FigCookies\SetCookie;
use Slim\Interfaces\RouteCollectorProxyInterface;
use Slim\App;
use League\Flysystem\DirectoryListing;
use League\Flysystem\FilesystemException;
use Closure;
use DateTime;
use DateTimeImmutable;
use DateInterval;
use Exception;
use InvalidArgumentException;

/**
 * Page class
 */
class KerjasamaEdit extends Kerjasama
{
    use MessagesTrait;
    use FormTrait;

    // Page ID
    public string $PageID = "edit";

    // Project ID
    public string $ProjectID = PROJECT_ID;

    // Page object name
    public string $PageObjName = "KerjasamaEdit";

    // View file path
    public ?string $View = null;

    // Title
    public ?string $Title = null; // Title for <title> tag

    // CSS class/style
    public string $CurrentPageName = "kerjasamaedit";

    // Page headings
    public string $Heading = "";
    public string $Subheading = "";
    public string $PageHeader = "";
    public string $PageFooter = "";

    // Page layout
    public bool $UseLayout = true;

    // Page terminated
    private bool $terminated = false;

    // Page heading
    public function pageHeading(): string
    {
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading(): string
    {
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return Language()->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName(): string
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl(bool $withArgs = true): string
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader(): void
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<div id="ew-page-header">' . $header . '</div>';
        }
    }

    // Show Page Footer
    public function showPageFooter(): void
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<div id="ew-page-footer">' . $footer . '</div>';
        }
    }

    // Set field visibility
    public function setVisibility(): void
    {
        $this->kerjasama_id->setVisibility();
        $this->mitra_id->setVisibility();
        $this->judul_kerjasama->setVisibility();
        $this->deskripsi->setVisibility();
        $this->tanggal_mulai->setVisibility();
        $this->tanggal_berakhir->setVisibility();
        $this->jenis_kerjasama->setVisibility();
        $this->dokumen_path->setVisibility();
        $this->status->setVisibility();
    }

    // Constructor
    public function __construct(Language $language, AdvancedSecurity $security)
    {
        parent::__construct($language, $security);
        global $DashboardReport;
        $this->TableVar = 'kerjasama';
        $this->TableName = 'kerjasama';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Save if user language changed
        if (Param("language") !== null) {
            Profile()->setLanguageId(Param("language"))->saveToStorage();
        }

        // Table object (kerjasama)
        if (!isset($GLOBALS["kerjasama"]) || $GLOBALS["kerjasama"]::class == PROJECT_NAMESPACE . "kerjasama") {
            $GLOBALS["kerjasama"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'kerjasama');
        }

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();
    }

    // Is lookup
    public function isLookup(): bool
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill(): bool
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest(): bool
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup(): bool
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated(): bool
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string|bool $url URL for direction, true => show response for API
     * @return void
     */
    public function terminate(string|bool $url = ""): void
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }
        DispatchEvent(new PageUnloadedEvent($this), PageUnloadedEvent::NAME);
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (HasJsonResponse()) { // Has JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!IsDebug() && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $pageName = GetPageName($url);
                $result = ["url" => GetUrl($url), "modal" => "1"];  // Assume return to modal for simplicity
                if (
                    SameString($pageName, GetPageName($this->getListUrl()))
                    || SameString($pageName, GetPageName($this->getViewUrl()))
                    || SameString($pageName, GetPageName(CurrentMasterTable()?->getViewUrl() ?? ""))
                ) { // List / View / Master View page
                    if (!SameString($pageName, GetPageName($this->getListUrl()))) { // Not List page
                        $result["caption"] = $this->getModalCaption($pageName);
                        $result["view"] = SameString($pageName, "kerjasamaview"); // If View page, no primary button
                    } else { // List page
                        $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                    }
                } else { // Other pages (add messages and then clear messages)
                    $result = array_merge($this->getMessages(), ["modal" => "1"]);
                    $this->clearMessages();
                }
                WriteJson($result);
            } else {
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from result set
    protected function getRecordsFromResult(Result|array $result, bool $current = false): array
    {
        $rows = [];
        if ($result instanceof Result) { // Result
            while ($row = $result->fetchAssociative()) {
                $this->loadRowValues($row); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($row);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        } elseif (is_array($result)) {
            foreach ($result as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray(array $ar): array
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (isset($this->Fields[$fldname]) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (IsEmpty($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DataType::BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->uploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->uploadPath() . $file)));
                                    if (!IsEmpty($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue(array $ar): string
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['kerjasama_id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit(): void
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->kerjasama_id->Visible = false;
        }
    }

    // Lookup data
    public function lookup(array $req = [], bool $response = true): array|bool
    {
        // Get lookup object
        $fieldName = $req["field"] ?? null;
        if (!$fieldName) {
            return [];
        }
        $fld = $this->Fields[$fieldName];
        $lookup = $fld->Lookup;
        $name = $req["name"] ?? "";
        if (ContainsString($name, "query_builder_rule")) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $req["ajax"] ?? "unknown";
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $req["q"] ?? $req["sv"] ?? "";
            $pageSize = $req["n"] ?? $req["recperpage"] ?? 10;
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $req["q"] ?? "";
            $pageSize = $req["n"] ?? -1;
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $req["start"] ?? -1;
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $req["page"] ?? -1;
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($req["s"] ?? "");
        $userFilter = Decrypt($req["f"] ?? "");
        $userOrderBy = Decrypt($req["o"] ?? "");
        $keys = $req["keys"] ?? null;
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $req["v0"] ?? $req["lookupValue"] ?? "";
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $req["v" . $i] ?? "";
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, $response); // Use settings from current page
    }

    // Properties
    public string $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public bool $IsModal = false;
    public bool $IsMobileOrModal = false;
    public ?string $DbMasterFilter = "";
    public string $DbDetailFilter = "";
    public ?string $HashValue = null; // Hash Value
    public int $DisplayRecords = 1;
    public int $StartRecord = 0;
    public int $StopRecord = 0;
    public int $TotalRecords = 0;
    public int $RecordRange = 10;
    public int $RecordCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run(): void
    {
        global $ExportType, $SkipHeaderFooter;

// Is modal
        $this->IsModal = IsModal();
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));
        $this->CurrentAction = Param("action"); // Set up current action
        $this->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

		// Call this new function from userfn*.php file
		My_Global_Check(); // Modified by Masino Sinaga, September 10, 2023

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

		// Begin of Compare Root URL by Masino Sinaga, September 10, 2023
		if (MS_ALWAYS_COMPARE_ROOT_URL == TRUE) {
			if (isset($_SESSION['humaskerjasama_Root_URL'])) {
				if ($_SESSION['humaskerjasama_Root_URL'] == MS_OTHER_COMPARED_ROOT_URL && $_SESSION['humaskerjasama_Root_URL'] <> "") {
					$this->setFailureMessage(str_replace("%s", MS_OTHER_COMPARED_ROOT_URL, Container("language")->phrase("NoPermission")));
					header("Location: " . $_SESSION['humaskerjasama_Root_URL']);
				}
			}
		}
		// End of Compare Root URL by Masino Sinaga, September 10, 2023

        // Set up lookup cache
        $this->setupLookupOptions($this->jenis_kerjasama);
        $this->setupLookupOptions($this->status);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("kerjasama_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->kerjasama_id->setQueryStringValue($keyValue);
                $this->kerjasama_id->setOldValue($this->kerjasama_id->QueryStringValue);
            } elseif (Post("kerjasama_id") !== null) {
                $this->kerjasama_id->setFormValue(Post("kerjasama_id"));
                $this->kerjasama_id->setOldValue($this->kerjasama_id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($this->language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action", "") !== "") {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey($this->getOldKey(), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("kerjasama_id") ?? Route("kerjasama_id")) !== null) {
                    $this->kerjasama_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->kerjasama_id->CurrentValue = null;
                }
            }

            // Load result set
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if (!$this->peekFailureMessage()) {
                            $this->setFailureMessage($this->language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("kerjasamalist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "kerjasamalist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                if ($this->editRow()) { // Update record based on key
                    CleanUploadTempPaths(SessionId());
                    if (!$this->peekSuccessMessage()) {
                        $this->setSuccessMessage($this->language->phrase("UpdateSuccess")); // Update success
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "kerjasamalist") {
                            FlashBag()->add("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "kerjasamalist"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson(["success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage()]);
                    $this->terminate();
                    return;
                } elseif (($this->peekFailureMessage()[0] ?? "") == $this->language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = RowType::EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            DispatchEvent(new PageRenderingEvent($this), PageRenderingEvent::NAME);

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

// Get upload files
    protected function getUploadFiles(): void
    {
    }

    // Load form values
    protected function loadFormValues(): void
    {
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'kerjasama_id' before field var 'x_kerjasama_id'
        $val = $this->getFormValue("kerjasama_id", null) ?? $this->getFormValue("x_kerjasama_id", null);
        if (!$this->kerjasama_id->IsDetailKey) {
            $this->kerjasama_id->setFormValue($val);
        }

        // Check field name 'mitra_id' before field var 'x_mitra_id'
        $val = $this->getFormValue("mitra_id", null) ?? $this->getFormValue("x_mitra_id", null);
        if (!$this->mitra_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->mitra_id->Visible = false; // Disable update for API request
            } else {
                $this->mitra_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'judul_kerjasama' before field var 'x_judul_kerjasama'
        $val = $this->getFormValue("judul_kerjasama", null) ?? $this->getFormValue("x_judul_kerjasama", null);
        if (!$this->judul_kerjasama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->judul_kerjasama->Visible = false; // Disable update for API request
            } else {
                $this->judul_kerjasama->setFormValue($val);
            }
        }

        // Check field name 'deskripsi' before field var 'x_deskripsi'
        $val = $this->getFormValue("deskripsi", null) ?? $this->getFormValue("x_deskripsi", null);
        if (!$this->deskripsi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deskripsi->Visible = false; // Disable update for API request
            } else {
                $this->deskripsi->setFormValue($val);
            }
        }

        // Check field name 'tanggal_mulai' before field var 'x_tanggal_mulai'
        $val = $this->getFormValue("tanggal_mulai", null) ?? $this->getFormValue("x_tanggal_mulai", null);
        if (!$this->tanggal_mulai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_mulai->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_mulai->setFormValue($val, true, $validate);
            }
            $this->tanggal_mulai->CurrentValue = UnformatDateTime($this->tanggal_mulai->CurrentValue, $this->tanggal_mulai->formatPattern());
        }

        // Check field name 'tanggal_berakhir' before field var 'x_tanggal_berakhir'
        $val = $this->getFormValue("tanggal_berakhir", null) ?? $this->getFormValue("x_tanggal_berakhir", null);
        if (!$this->tanggal_berakhir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_berakhir->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_berakhir->setFormValue($val, true, $validate);
            }
            $this->tanggal_berakhir->CurrentValue = UnformatDateTime($this->tanggal_berakhir->CurrentValue, $this->tanggal_berakhir->formatPattern());
        }

        // Check field name 'jenis_kerjasama' before field var 'x_jenis_kerjasama'
        $val = $this->getFormValue("jenis_kerjasama", null) ?? $this->getFormValue("x_jenis_kerjasama", null);
        if (!$this->jenis_kerjasama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jenis_kerjasama->Visible = false; // Disable update for API request
            } else {
                $this->jenis_kerjasama->setFormValue($val);
            }
        }

        // Check field name 'dokumen_path' before field var 'x_dokumen_path'
        $val = $this->getFormValue("dokumen_path", null) ?? $this->getFormValue("x_dokumen_path", null);
        if (!$this->dokumen_path->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dokumen_path->Visible = false; // Disable update for API request
            } else {
                $this->dokumen_path->setFormValue($val);
            }
        }

        // Check field name 'status' before field var 'x_status'
        $val = $this->getFormValue("status", null) ?? $this->getFormValue("x_status", null);
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues(): void
    {
        $this->kerjasama_id->CurrentValue = $this->kerjasama_id->FormValue;
        $this->mitra_id->CurrentValue = $this->mitra_id->FormValue;
        $this->judul_kerjasama->CurrentValue = $this->judul_kerjasama->FormValue;
        $this->deskripsi->CurrentValue = $this->deskripsi->FormValue;
        $this->tanggal_mulai->CurrentValue = $this->tanggal_mulai->FormValue;
        $this->tanggal_mulai->CurrentValue = UnformatDateTime($this->tanggal_mulai->CurrentValue, $this->tanggal_mulai->formatPattern());
        $this->tanggal_berakhir->CurrentValue = $this->tanggal_berakhir->FormValue;
        $this->tanggal_berakhir->CurrentValue = UnformatDateTime($this->tanggal_berakhir->CurrentValue, $this->tanggal_berakhir->formatPattern());
        $this->jenis_kerjasama->CurrentValue = $this->jenis_kerjasama->FormValue;
        $this->dokumen_path->CurrentValue = $this->dokumen_path->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return bool
     */
    public function loadRow(): bool
    {
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from result set or record
     *
     * @param array|bool|null $row Record
     * @return void
     */
    public function loadRowValues(array|bool|null $row = null): void
    {
        $row = is_array($row) ? $row : $this->newRow();

        // Call Row Selected event
        $this->rowSelected($row);
        $this->kerjasama_id->setDbValue($row['kerjasama_id']);
        $this->mitra_id->setDbValue($row['mitra_id']);
        $this->judul_kerjasama->setDbValue($row['judul_kerjasama']);
        $this->deskripsi->setDbValue($row['deskripsi']);
        $this->tanggal_mulai->setDbValue($row['tanggal_mulai']);
        $this->tanggal_berakhir->setDbValue($row['tanggal_berakhir']);
        $this->jenis_kerjasama->setDbValue($row['jenis_kerjasama']);
        $this->dokumen_path->setDbValue($row['dokumen_path']);
        $this->status->setDbValue($row['status']);
    }

    // Return a row with default values
    protected function newRow(): array
    {
        $row = [];
        $row['kerjasama_id'] = $this->kerjasama_id->DefaultValue;
        $row['mitra_id'] = $this->mitra_id->DefaultValue;
        $row['judul_kerjasama'] = $this->judul_kerjasama->DefaultValue;
        $row['deskripsi'] = $this->deskripsi->DefaultValue;
        $row['tanggal_mulai'] = $this->tanggal_mulai->DefaultValue;
        $row['tanggal_berakhir'] = $this->tanggal_berakhir->DefaultValue;
        $row['jenis_kerjasama'] = $this->jenis_kerjasama->DefaultValue;
        $row['dokumen_path'] = $this->dokumen_path->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord(): ?array
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $result = ExecuteQuery($sql, $conn);
            if ($row = $result->fetchAssociative()) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow(): void
    {
        global $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // kerjasama_id
        $this->kerjasama_id->RowCssClass = "row";

        // mitra_id
        $this->mitra_id->RowCssClass = "row";

        // judul_kerjasama
        $this->judul_kerjasama->RowCssClass = "row";

        // deskripsi
        $this->deskripsi->RowCssClass = "row";

        // tanggal_mulai
        $this->tanggal_mulai->RowCssClass = "row";

        // tanggal_berakhir
        $this->tanggal_berakhir->RowCssClass = "row";

        // jenis_kerjasama
        $this->jenis_kerjasama->RowCssClass = "row";

        // dokumen_path
        $this->dokumen_path->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // kerjasama_id
            $this->kerjasama_id->ViewValue = $this->kerjasama_id->CurrentValue;

            // mitra_id
            $this->mitra_id->ViewValue = $this->mitra_id->CurrentValue;
            $this->mitra_id->ViewValue = FormatNumber($this->mitra_id->ViewValue, $this->mitra_id->formatPattern());

            // judul_kerjasama
            $this->judul_kerjasama->ViewValue = $this->judul_kerjasama->CurrentValue;

            // deskripsi
            $this->deskripsi->ViewValue = $this->deskripsi->CurrentValue;

            // tanggal_mulai
            $this->tanggal_mulai->ViewValue = $this->tanggal_mulai->CurrentValue;
            $this->tanggal_mulai->ViewValue = FormatDateTime($this->tanggal_mulai->ViewValue, $this->tanggal_mulai->formatPattern());

            // tanggal_berakhir
            $this->tanggal_berakhir->ViewValue = $this->tanggal_berakhir->CurrentValue;
            $this->tanggal_berakhir->ViewValue = FormatDateTime($this->tanggal_berakhir->ViewValue, $this->tanggal_berakhir->formatPattern());

            // jenis_kerjasama
            if (strval($this->jenis_kerjasama->CurrentValue) != "") {
                $this->jenis_kerjasama->ViewValue = $this->jenis_kerjasama->optionCaption($this->jenis_kerjasama->CurrentValue);
            } else {
                $this->jenis_kerjasama->ViewValue = null;
            }

            // dokumen_path
            $this->dokumen_path->ViewValue = $this->dokumen_path->CurrentValue;

            // status
            if (strval($this->status->CurrentValue) != "") {
                $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
            } else {
                $this->status->ViewValue = null;
            }

            // kerjasama_id
            $this->kerjasama_id->HrefValue = "";

            // mitra_id
            $this->mitra_id->HrefValue = "";

            // judul_kerjasama
            $this->judul_kerjasama->HrefValue = "";

            // deskripsi
            $this->deskripsi->HrefValue = "";

            // tanggal_mulai
            $this->tanggal_mulai->HrefValue = "";

            // tanggal_berakhir
            $this->tanggal_berakhir->HrefValue = "";

            // jenis_kerjasama
            $this->jenis_kerjasama->HrefValue = "";

            // dokumen_path
            $this->dokumen_path->HrefValue = "";

            // status
            $this->status->HrefValue = "";
        } elseif ($this->RowType == RowType::EDIT) {
            // kerjasama_id
            $this->kerjasama_id->setupEditAttributes();
            $this->kerjasama_id->EditValue = $this->kerjasama_id->CurrentValue;

            // mitra_id
            $this->mitra_id->setupEditAttributes();
            $this->mitra_id->EditValue = $this->mitra_id->CurrentValue;
            $this->mitra_id->PlaceHolder = RemoveHtml($this->mitra_id->caption());
            if (strval($this->mitra_id->EditValue) != "" && is_numeric($this->mitra_id->EditValue)) {
                $this->mitra_id->EditValue = FormatNumber($this->mitra_id->EditValue, null);
            }

            // judul_kerjasama
            $this->judul_kerjasama->setupEditAttributes();
            $this->judul_kerjasama->EditValue = !$this->judul_kerjasama->Raw ? HtmlDecode($this->judul_kerjasama->CurrentValue) : $this->judul_kerjasama->CurrentValue;
            $this->judul_kerjasama->PlaceHolder = RemoveHtml($this->judul_kerjasama->caption());

            // deskripsi
            $this->deskripsi->setupEditAttributes();
            $this->deskripsi->EditValue = !$this->deskripsi->Raw ? HtmlDecode($this->deskripsi->CurrentValue) : $this->deskripsi->CurrentValue;
            $this->deskripsi->PlaceHolder = RemoveHtml($this->deskripsi->caption());

            // tanggal_mulai
            $this->tanggal_mulai->setupEditAttributes();
            $this->tanggal_mulai->EditValue = FormatDateTime($this->tanggal_mulai->CurrentValue, $this->tanggal_mulai->formatPattern());
            $this->tanggal_mulai->PlaceHolder = RemoveHtml($this->tanggal_mulai->caption());

            // tanggal_berakhir
            $this->tanggal_berakhir->setupEditAttributes();
            $this->tanggal_berakhir->EditValue = FormatDateTime($this->tanggal_berakhir->CurrentValue, $this->tanggal_berakhir->formatPattern());
            $this->tanggal_berakhir->PlaceHolder = RemoveHtml($this->tanggal_berakhir->caption());

            // jenis_kerjasama
            $this->jenis_kerjasama->EditValue = $this->jenis_kerjasama->options(false);
            $this->jenis_kerjasama->PlaceHolder = RemoveHtml($this->jenis_kerjasama->caption());

            // dokumen_path
            $this->dokumen_path->setupEditAttributes();
            $this->dokumen_path->EditValue = !$this->dokumen_path->Raw ? HtmlDecode($this->dokumen_path->CurrentValue) : $this->dokumen_path->CurrentValue;
            $this->dokumen_path->PlaceHolder = RemoveHtml($this->dokumen_path->caption());

            // status
            $this->status->EditValue = $this->status->options(false);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // Edit refer script

            // kerjasama_id
            $this->kerjasama_id->HrefValue = "";

            // mitra_id
            $this->mitra_id->HrefValue = "";

            // judul_kerjasama
            $this->judul_kerjasama->HrefValue = "";

            // deskripsi
            $this->deskripsi->HrefValue = "";

            // tanggal_mulai
            $this->tanggal_mulai->HrefValue = "";

            // tanggal_berakhir
            $this->tanggal_berakhir->HrefValue = "";

            // jenis_kerjasama
            $this->jenis_kerjasama->HrefValue = "";

            // dokumen_path
            $this->dokumen_path->HrefValue = "";

            // status
            $this->status->HrefValue = "";
        }
        if ($this->RowType == RowType::ADD || $this->RowType == RowType::EDIT || $this->RowType == RowType::SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != RowType::AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm(): bool
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
            if ($this->kerjasama_id->Visible && $this->kerjasama_id->Required) {
                if (!$this->kerjasama_id->IsDetailKey && IsEmpty($this->kerjasama_id->FormValue)) {
                    $this->kerjasama_id->addErrorMessage(str_replace("%s", $this->kerjasama_id->caption(), $this->kerjasama_id->RequiredErrorMessage));
                }
            }
            if ($this->mitra_id->Visible && $this->mitra_id->Required) {
                if (!$this->mitra_id->IsDetailKey && IsEmpty($this->mitra_id->FormValue)) {
                    $this->mitra_id->addErrorMessage(str_replace("%s", $this->mitra_id->caption(), $this->mitra_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->mitra_id->FormValue)) {
                $this->mitra_id->addErrorMessage($this->mitra_id->getErrorMessage(false));
            }
            if ($this->judul_kerjasama->Visible && $this->judul_kerjasama->Required) {
                if (!$this->judul_kerjasama->IsDetailKey && IsEmpty($this->judul_kerjasama->FormValue)) {
                    $this->judul_kerjasama->addErrorMessage(str_replace("%s", $this->judul_kerjasama->caption(), $this->judul_kerjasama->RequiredErrorMessage));
                }
            }
            if ($this->deskripsi->Visible && $this->deskripsi->Required) {
                if (!$this->deskripsi->IsDetailKey && IsEmpty($this->deskripsi->FormValue)) {
                    $this->deskripsi->addErrorMessage(str_replace("%s", $this->deskripsi->caption(), $this->deskripsi->RequiredErrorMessage));
                }
            }
            if ($this->tanggal_mulai->Visible && $this->tanggal_mulai->Required) {
                if (!$this->tanggal_mulai->IsDetailKey && IsEmpty($this->tanggal_mulai->FormValue)) {
                    $this->tanggal_mulai->addErrorMessage(str_replace("%s", $this->tanggal_mulai->caption(), $this->tanggal_mulai->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->tanggal_mulai->FormValue, $this->tanggal_mulai->formatPattern())) {
                $this->tanggal_mulai->addErrorMessage($this->tanggal_mulai->getErrorMessage(false));
            }
            if ($this->tanggal_berakhir->Visible && $this->tanggal_berakhir->Required) {
                if (!$this->tanggal_berakhir->IsDetailKey && IsEmpty($this->tanggal_berakhir->FormValue)) {
                    $this->tanggal_berakhir->addErrorMessage(str_replace("%s", $this->tanggal_berakhir->caption(), $this->tanggal_berakhir->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->tanggal_berakhir->FormValue, $this->tanggal_berakhir->formatPattern())) {
                $this->tanggal_berakhir->addErrorMessage($this->tanggal_berakhir->getErrorMessage(false));
            }
            if ($this->jenis_kerjasama->Visible && $this->jenis_kerjasama->Required) {
                if ($this->jenis_kerjasama->FormValue == "") {
                    $this->jenis_kerjasama->addErrorMessage(str_replace("%s", $this->jenis_kerjasama->caption(), $this->jenis_kerjasama->RequiredErrorMessage));
                }
            }
            if ($this->dokumen_path->Visible && $this->dokumen_path->Required) {
                if (!$this->dokumen_path->IsDetailKey && IsEmpty($this->dokumen_path->FormValue)) {
                    $this->dokumen_path->addErrorMessage(str_replace("%s", $this->dokumen_path->caption(), $this->dokumen_path->RequiredErrorMessage));
                }
            }
            if ($this->status->Visible && $this->status->Required) {
                if ($this->status->FormValue == "") {
                    $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
                }
            }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow(): bool
    {
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $oldRow = $conn->fetchAssociative($sql);
        if (!$oldRow) {
            $this->setFailureMessage($this->language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Load old values
            $this->loadDbValues($oldRow);
        }

        // Get new row
        $newRow = $this->getEditRow($oldRow);

        // Update current values
        $this->Fields->setCurrentValues($newRow);

        // Call Row Updating event
        $updateRow = $this->rowUpdating($oldRow, $newRow);
        if ($updateRow) {
            if (count($newRow) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($newRow, "", $oldRow);
                if (!$editRow && !IsEmpty($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->peekSuccessMessage() || $this->peekFailureMessage()) {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($this->language->phrase("UpdateCancelled"));
            }
            $editRow = $updateRow;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($oldRow, $newRow);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromResult([$newRow], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    /**
     * Get edit row
     *
     * @return array
     */
    protected function getEditRow(array $oldRow): array
    {
        $newRow = [];

        // mitra_id
        $this->mitra_id->setDbValueDef($newRow, $this->mitra_id->CurrentValue, $this->mitra_id->ReadOnly);

        // judul_kerjasama
        $this->judul_kerjasama->setDbValueDef($newRow, $this->judul_kerjasama->CurrentValue, $this->judul_kerjasama->ReadOnly);

        // deskripsi
        $this->deskripsi->setDbValueDef($newRow, $this->deskripsi->CurrentValue, $this->deskripsi->ReadOnly);

        // tanggal_mulai
        $this->tanggal_mulai->setDbValueDef($newRow, UnFormatDateTime($this->tanggal_mulai->CurrentValue, $this->tanggal_mulai->formatPattern()), $this->tanggal_mulai->ReadOnly);

        // tanggal_berakhir
        $this->tanggal_berakhir->setDbValueDef($newRow, UnFormatDateTime($this->tanggal_berakhir->CurrentValue, $this->tanggal_berakhir->formatPattern()), $this->tanggal_berakhir->ReadOnly);

        // jenis_kerjasama
        $this->jenis_kerjasama->setDbValueDef($newRow, $this->jenis_kerjasama->CurrentValue, $this->jenis_kerjasama->ReadOnly);

        // dokumen_path
        $this->dokumen_path->setDbValueDef($newRow, $this->dokumen_path->CurrentValue, $this->dokumen_path->ReadOnly);

        // status
        $this->status->setDbValueDef($newRow, $this->status->CurrentValue, $this->status->ReadOnly);
        return $newRow;
    }

    /**
     * Restore edit form from row
     * @param array $row Row
     */
    protected function restoreEditFormFromRow(array $row): void
    {
        if (isset($row['mitra_id'])) { // mitra_id
            $this->mitra_id->CurrentValue = $row['mitra_id'];
        }
        if (isset($row['judul_kerjasama'])) { // judul_kerjasama
            $this->judul_kerjasama->CurrentValue = $row['judul_kerjasama'];
        }
        if (isset($row['deskripsi'])) { // deskripsi
            $this->deskripsi->CurrentValue = $row['deskripsi'];
        }
        if (isset($row['tanggal_mulai'])) { // tanggal_mulai
            $this->tanggal_mulai->CurrentValue = $row['tanggal_mulai'];
        }
        if (isset($row['tanggal_berakhir'])) { // tanggal_berakhir
            $this->tanggal_berakhir->CurrentValue = $row['tanggal_berakhir'];
        }
        if (isset($row['jenis_kerjasama'])) { // jenis_kerjasama
            $this->jenis_kerjasama->CurrentValue = $row['jenis_kerjasama'];
        }
        if (isset($row['dokumen_path'])) { // dokumen_path
            $this->dokumen_path->CurrentValue = $row['dokumen_path'];
        }
        if (isset($row['status'])) { // status
            $this->status->CurrentValue = $row['status'];
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb(): void
    {
        $breadcrumb = Breadcrumb();
        $url = CurrentUrl();
        $breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("kerjasamalist"), "", $this->TableVar, true);
        $pageId = "edit";
        $breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions(DbField $fld): void
    {
        if ($fld->Lookup && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_jenis_kerjasama":
                    break;
                case "x_status":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $qb = $fld->Lookup->getSqlAsQueryBuilder(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $qb != null && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($qb, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                // Get lookup cache Id
                $sql = $qb->getSQL();
                $lookupCacheKey = "lookup.cache." . Container($fld->Lookup->LinkTable)->TableVar . ".";
                $cacheId = $lookupCacheKey . hash("xxh128", $sql); // Hash value of SQL as cache id
                // Prune stale data first
                Container("result.cache")->prune();
                // Use result cache
                $cacheProfile = new QueryCacheProfile(0, $cacheId, Container("result.cache"));
                $rows = $conn->executeCacheQuery($sql, [], [], $cacheProfile)->fetchAllAssociative();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord(): void
    {
        $pagerTable = Get(Config("TABLE_PAGER_TABLE_NAME"));
        if ($this->DisplayRecords == 0 || $pagerTable && $pagerTable != $this->TableVar) { // Display all records / Check if paging for this table
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount(): int
    {
        return ceil($this->TotalRecords / $this->DisplayRecords);
    }

    // Page Load event
    public function pageLoad(): void
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload(): void
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(string &$url): void
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(string &$message, string $type): void
    {
        if ($type == "success") {
            //$message = "your success message";
        } elseif ($type == "failure") {
            //$message = "your failure message";
        } elseif ($type == "warning") {
            //$message = "your warning message";
        } else {
            //$message = "your message";
        }
    }

    // Page Render event
    public function pageRender(): void
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(string &$header): void
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(string &$footer): void
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(bool &$break, string &$content): void
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(string &$customError): bool
    {
        // Return error message in $customError
        return true;
    }
}
