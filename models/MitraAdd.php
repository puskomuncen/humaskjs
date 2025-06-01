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
class MitraAdd extends Mitra
{
    use MessagesTrait;
    use FormTrait;

    // Page ID
    public string $PageID = "add";

    // Project ID
    public string $ProjectID = PROJECT_ID;

    // Page object name
    public string $PageObjName = "MitraAdd";

    // View file path
    public ?string $View = null;

    // Title
    public ?string $Title = null; // Title for <title> tag

    // CSS class/style
    public string $CurrentPageName = "mitraadd";

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
        $this->mitra_id->Visible = false;
        $this->nama_mitra->setVisibility();
        $this->jenis_mitra->setVisibility();
        $this->alamat->setVisibility();
        $this->email->setVisibility();
        $this->telepon->setVisibility();
        $this->tanggal_bergabung->setVisibility();
        $this->status_aktif->setVisibility();
    }

    // Constructor
    public function __construct(Language $language, AdvancedSecurity $security)
    {
        parent::__construct($language, $security);
        global $DashboardReport;
        $this->TableVar = 'mitra';
        $this->TableName = 'mitra';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Save if user language changed
        if (Param("language") !== null) {
            Profile()->setLanguageId(Param("language"))->saveToStorage();
        }

        // Table object (mitra)
        if (!isset($GLOBALS["mitra"]) || $GLOBALS["mitra"]::class == PROJECT_NAMESPACE . "mitra") {
            $GLOBALS["mitra"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'mitra');
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
                        $result["view"] = SameString($pageName, "mitraview"); // If View page, no primary button
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
            $key .= @$ar['mitra_id'];
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
            $this->mitra_id->Visible = false;
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
    public string $FormClassName = "ew-form ew-add-form";
    public bool $IsModal = false;
    public bool $IsMobileOrModal = false;
    public ?string $DbMasterFilter = "";
    public string $DbDetailFilter = "";
    public int $StartRecord = 0;
    public int $Priv = 0;
    public bool $CopyRecord = false;

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
        $this->setupLookupOptions($this->jenis_mitra);
        $this->setupLookupOptions($this->status_aktif);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey($this->getOldKey());
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("mitra_id") ?? Route("mitra_id")) !== null) {
                $this->mitra_id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !IsEmpty($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
                $this->setKey($this->OldKey); // Set up record key
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record or default values
        $oldRow = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$oldRow) { // Record not loaded
                    if (!$this->peekFailureMessage()) {
                        $this->setFailureMessage($this->language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("mitralist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                if ($this->addRow($oldRow)) { // Add successful
                    CleanUploadTempPaths(SessionId());
                    if (!$this->peekSuccessMessage() && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($this->language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "mitralist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "mitraview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "mitralist") {
                            FlashBag()->add("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "mitralist"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson(["success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage()]);
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = RowType::ADD; // Render add type

        // Render row
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

    // Load default values
    protected function loadDefaultValues(): void
    {
        $this->status_aktif->DefaultValue = $this->status_aktif->getDefault(); // PHP
        $this->status_aktif->OldValue = $this->status_aktif->DefaultValue;
    }

    // Load form values
    protected function loadFormValues(): void
    {
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'nama_mitra' before field var 'x_nama_mitra'
        $val = $this->getFormValue("nama_mitra", null) ?? $this->getFormValue("x_nama_mitra", null);
        if (!$this->nama_mitra->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_mitra->Visible = false; // Disable update for API request
            } else {
                $this->nama_mitra->setFormValue($val);
            }
        }

        // Check field name 'jenis_mitra' before field var 'x_jenis_mitra'
        $val = $this->getFormValue("jenis_mitra", null) ?? $this->getFormValue("x_jenis_mitra", null);
        if (!$this->jenis_mitra->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jenis_mitra->Visible = false; // Disable update for API request
            } else {
                $this->jenis_mitra->setFormValue($val);
            }
        }

        // Check field name 'alamat' before field var 'x_alamat'
        $val = $this->getFormValue("alamat", null) ?? $this->getFormValue("x_alamat", null);
        if (!$this->alamat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alamat->Visible = false; // Disable update for API request
            } else {
                $this->alamat->setFormValue($val);
            }
        }

        // Check field name 'email' before field var 'x_email'
        $val = $this->getFormValue("email", null) ?? $this->getFormValue("x_email", null);
        if (!$this->email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->email->Visible = false; // Disable update for API request
            } else {
                $this->email->setFormValue($val);
            }
        }

        // Check field name 'telepon' before field var 'x_telepon'
        $val = $this->getFormValue("telepon", null) ?? $this->getFormValue("x_telepon", null);
        if (!$this->telepon->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->telepon->Visible = false; // Disable update for API request
            } else {
                $this->telepon->setFormValue($val);
            }
        }

        // Check field name 'tanggal_bergabung' before field var 'x_tanggal_bergabung'
        $val = $this->getFormValue("tanggal_bergabung", null) ?? $this->getFormValue("x_tanggal_bergabung", null);
        if (!$this->tanggal_bergabung->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_bergabung->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_bergabung->setFormValue($val, true, $validate);
            }
            $this->tanggal_bergabung->CurrentValue = UnformatDateTime($this->tanggal_bergabung->CurrentValue, $this->tanggal_bergabung->formatPattern());
        }

        // Check field name 'status_aktif' before field var 'x_status_aktif'
        $val = $this->getFormValue("status_aktif", null) ?? $this->getFormValue("x_status_aktif", null);
        if (!$this->status_aktif->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status_aktif->Visible = false; // Disable update for API request
            } else {
                $this->status_aktif->setFormValue($val);
            }
        }

        // Check field name 'mitra_id' first before field var 'x_mitra_id'
        $val = $this->hasFormValue("mitra_id") ? $this->getFormValue("mitra_id") : $this->getFormValue("x_mitra_id");
    }

    // Restore form values
    public function restoreFormValues(): void
    {
        $this->nama_mitra->CurrentValue = $this->nama_mitra->FormValue;
        $this->jenis_mitra->CurrentValue = $this->jenis_mitra->FormValue;
        $this->alamat->CurrentValue = $this->alamat->FormValue;
        $this->email->CurrentValue = $this->email->FormValue;
        $this->telepon->CurrentValue = $this->telepon->FormValue;
        $this->tanggal_bergabung->CurrentValue = $this->tanggal_bergabung->FormValue;
        $this->tanggal_bergabung->CurrentValue = UnformatDateTime($this->tanggal_bergabung->CurrentValue, $this->tanggal_bergabung->formatPattern());
        $this->status_aktif->CurrentValue = $this->status_aktif->FormValue;
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
        $this->mitra_id->setDbValue($row['mitra_id']);
        $this->nama_mitra->setDbValue($row['nama_mitra']);
        $this->jenis_mitra->setDbValue($row['jenis_mitra']);
        $this->alamat->setDbValue($row['alamat']);
        $this->email->setDbValue($row['email']);
        $this->telepon->setDbValue($row['telepon']);
        $this->tanggal_bergabung->setDbValue($row['tanggal_bergabung']);
        $this->status_aktif->setDbValue($row['status_aktif']);
    }

    // Return a row with default values
    protected function newRow(): array
    {
        $row = [];
        $row['mitra_id'] = $this->mitra_id->DefaultValue;
        $row['nama_mitra'] = $this->nama_mitra->DefaultValue;
        $row['jenis_mitra'] = $this->jenis_mitra->DefaultValue;
        $row['alamat'] = $this->alamat->DefaultValue;
        $row['email'] = $this->email->DefaultValue;
        $row['telepon'] = $this->telepon->DefaultValue;
        $row['tanggal_bergabung'] = $this->tanggal_bergabung->DefaultValue;
        $row['status_aktif'] = $this->status_aktif->DefaultValue;
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

        // mitra_id
        $this->mitra_id->RowCssClass = "row";

        // nama_mitra
        $this->nama_mitra->RowCssClass = "row";

        // jenis_mitra
        $this->jenis_mitra->RowCssClass = "row";

        // alamat
        $this->alamat->RowCssClass = "row";

        // email
        $this->email->RowCssClass = "row";

        // telepon
        $this->telepon->RowCssClass = "row";

        // tanggal_bergabung
        $this->tanggal_bergabung->RowCssClass = "row";

        // status_aktif
        $this->status_aktif->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // mitra_id
            $this->mitra_id->ViewValue = $this->mitra_id->CurrentValue;

            // nama_mitra
            $this->nama_mitra->ViewValue = $this->nama_mitra->CurrentValue;

            // jenis_mitra
            if (strval($this->jenis_mitra->CurrentValue) != "") {
                $this->jenis_mitra->ViewValue = $this->jenis_mitra->optionCaption($this->jenis_mitra->CurrentValue);
            } else {
                $this->jenis_mitra->ViewValue = null;
            }

            // alamat
            $this->alamat->ViewValue = $this->alamat->CurrentValue;

            // email
            $this->email->ViewValue = $this->email->CurrentValue;

            // telepon
            $this->telepon->ViewValue = $this->telepon->CurrentValue;

            // tanggal_bergabung
            $this->tanggal_bergabung->ViewValue = $this->tanggal_bergabung->CurrentValue;
            $this->tanggal_bergabung->ViewValue = FormatDateTime($this->tanggal_bergabung->ViewValue, $this->tanggal_bergabung->formatPattern());

            // status_aktif
            if (ConvertToBool($this->status_aktif->CurrentValue)) {
                $this->status_aktif->ViewValue = $this->status_aktif->tagCaption(1) != "" ? $this->status_aktif->tagCaption(1) : "Yes";
            } else {
                $this->status_aktif->ViewValue = $this->status_aktif->tagCaption(2) != "" ? $this->status_aktif->tagCaption(2) : "No";
            }

            // nama_mitra
            $this->nama_mitra->HrefValue = "";

            // jenis_mitra
            $this->jenis_mitra->HrefValue = "";

            // alamat
            $this->alamat->HrefValue = "";

            // email
            $this->email->HrefValue = "";

            // telepon
            $this->telepon->HrefValue = "";

            // tanggal_bergabung
            $this->tanggal_bergabung->HrefValue = "";

            // status_aktif
            $this->status_aktif->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // nama_mitra
            $this->nama_mitra->setupEditAttributes();
            $this->nama_mitra->EditValue = !$this->nama_mitra->Raw ? HtmlDecode($this->nama_mitra->CurrentValue) : $this->nama_mitra->CurrentValue;
            $this->nama_mitra->PlaceHolder = RemoveHtml($this->nama_mitra->caption());

            // jenis_mitra
            $this->jenis_mitra->EditValue = $this->jenis_mitra->options(false);
            $this->jenis_mitra->PlaceHolder = RemoveHtml($this->jenis_mitra->caption());

            // alamat
            $this->alamat->setupEditAttributes();
            $this->alamat->EditValue = !$this->alamat->Raw ? HtmlDecode($this->alamat->CurrentValue) : $this->alamat->CurrentValue;
            $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

            // email
            $this->email->setupEditAttributes();
            $this->email->EditValue = !$this->email->Raw ? HtmlDecode($this->email->CurrentValue) : $this->email->CurrentValue;
            $this->email->PlaceHolder = RemoveHtml($this->email->caption());

            // telepon
            $this->telepon->setupEditAttributes();
            $this->telepon->EditValue = !$this->telepon->Raw ? HtmlDecode($this->telepon->CurrentValue) : $this->telepon->CurrentValue;
            $this->telepon->PlaceHolder = RemoveHtml($this->telepon->caption());

            // tanggal_bergabung
            $this->tanggal_bergabung->setupEditAttributes();
            $this->tanggal_bergabung->EditValue = FormatDateTime($this->tanggal_bergabung->CurrentValue, $this->tanggal_bergabung->formatPattern());
            $this->tanggal_bergabung->PlaceHolder = RemoveHtml($this->tanggal_bergabung->caption());

            // status_aktif
            $this->status_aktif->EditValue = $this->status_aktif->options(false);
            $this->status_aktif->PlaceHolder = RemoveHtml($this->status_aktif->caption());

            // Add refer script

            // nama_mitra
            $this->nama_mitra->HrefValue = "";

            // jenis_mitra
            $this->jenis_mitra->HrefValue = "";

            // alamat
            $this->alamat->HrefValue = "";

            // email
            $this->email->HrefValue = "";

            // telepon
            $this->telepon->HrefValue = "";

            // tanggal_bergabung
            $this->tanggal_bergabung->HrefValue = "";

            // status_aktif
            $this->status_aktif->HrefValue = "";
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
            if ($this->nama_mitra->Visible && $this->nama_mitra->Required) {
                if (!$this->nama_mitra->IsDetailKey && IsEmpty($this->nama_mitra->FormValue)) {
                    $this->nama_mitra->addErrorMessage(str_replace("%s", $this->nama_mitra->caption(), $this->nama_mitra->RequiredErrorMessage));
                }
            }
            if ($this->jenis_mitra->Visible && $this->jenis_mitra->Required) {
                if ($this->jenis_mitra->FormValue == "") {
                    $this->jenis_mitra->addErrorMessage(str_replace("%s", $this->jenis_mitra->caption(), $this->jenis_mitra->RequiredErrorMessage));
                }
            }
            if ($this->alamat->Visible && $this->alamat->Required) {
                if (!$this->alamat->IsDetailKey && IsEmpty($this->alamat->FormValue)) {
                    $this->alamat->addErrorMessage(str_replace("%s", $this->alamat->caption(), $this->alamat->RequiredErrorMessage));
                }
            }
            if ($this->email->Visible && $this->email->Required) {
                if (!$this->email->IsDetailKey && IsEmpty($this->email->FormValue)) {
                    $this->email->addErrorMessage(str_replace("%s", $this->email->caption(), $this->email->RequiredErrorMessage));
                }
            }
            if ($this->telepon->Visible && $this->telepon->Required) {
                if (!$this->telepon->IsDetailKey && IsEmpty($this->telepon->FormValue)) {
                    $this->telepon->addErrorMessage(str_replace("%s", $this->telepon->caption(), $this->telepon->RequiredErrorMessage));
                }
            }
            if ($this->tanggal_bergabung->Visible && $this->tanggal_bergabung->Required) {
                if (!$this->tanggal_bergabung->IsDetailKey && IsEmpty($this->tanggal_bergabung->FormValue)) {
                    $this->tanggal_bergabung->addErrorMessage(str_replace("%s", $this->tanggal_bergabung->caption(), $this->tanggal_bergabung->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->tanggal_bergabung->FormValue, $this->tanggal_bergabung->formatPattern())) {
                $this->tanggal_bergabung->addErrorMessage($this->tanggal_bergabung->getErrorMessage(false));
            }
            if ($this->status_aktif->Visible && $this->status_aktif->Required) {
                if ($this->status_aktif->FormValue == "") {
                    $this->status_aktif->addErrorMessage(str_replace("%s", $this->status_aktif->caption(), $this->status_aktif->RequiredErrorMessage));
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

    // Add record
    protected function addRow(?array $oldRow = null): bool
    {
        // Get new row
        $newRow = $this->getAddRow();

        // Update current values
        $this->Fields->setCurrentValues($newRow);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($oldRow);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($oldRow, $newRow);
        if ($insertRow) {
            $addRow = $this->insert($newRow);
            if ($addRow) {
            } elseif (!IsEmpty($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->peekSuccessMessage() || $this->peekFailureMessage()) {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($this->language->phrase("InsertCancelled"));
            }
            $addRow = $insertRow;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($oldRow, $newRow);
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromResult([$newRow], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    /**
     * Get add row
     *
     * @return array
     */
    protected function getAddRow(): array
    {
        $newRow = [];

        // nama_mitra
        $this->nama_mitra->setDbValueDef($newRow, $this->nama_mitra->CurrentValue, false);

        // jenis_mitra
        $this->jenis_mitra->setDbValueDef($newRow, $this->jenis_mitra->CurrentValue, false);

        // alamat
        $this->alamat->setDbValueDef($newRow, $this->alamat->CurrentValue, false);

        // email
        $this->email->setDbValueDef($newRow, $this->email->CurrentValue, false);

        // telepon
        $this->telepon->setDbValueDef($newRow, $this->telepon->CurrentValue, false);

        // tanggal_bergabung
        $this->tanggal_bergabung->setDbValueDef($newRow, UnFormatDateTime($this->tanggal_bergabung->CurrentValue, $this->tanggal_bergabung->formatPattern()), false);

        // status_aktif
        $tmpBool = $this->status_aktif->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->status_aktif->setDbValueDef($newRow, $tmpBool, strval($this->status_aktif->CurrentValue) == "");
        return $newRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb(): void
    {
        $breadcrumb = Breadcrumb();
        $url = CurrentUrl();
        $breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("mitralist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $breadcrumb->add("add", $pageId, $url);
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
                case "x_jenis_mitra":
                    break;
                case "x_status_aktif":
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
