<?php
$Query= "
SELECT
  IFNULL(pprr.COMPANYID,36) AS CompanyId,
  pprg.UNIT AS Unit,
  CONCAT(pprr.APP_NUMBER, '-', pprg.ROW) AS InqueryNumber,
  IFNULL(pprr.WAREHOUSE_NAME_LABEL,pprr.STOCK_NAME_LABEL) AS StockName,
  pprr.REQ_NAME_LABEL  AS RequstPersonName,
  pprg.ITEMS AS Name,
  REPLACE(pprg.APPROVED_NUMBER,',','') AS NUMBER,
  null AS Brand,
  pprg.TECHNICAL_PROPERTY AS DescriptionFani,
  pprg.DATE_REQUIRED AS RequiredDate,
  pprr.MANAGER_BUSINESS_DESC_LABEL AS Descriptionkarshenas
FROM pmt_purchase_raw_material_report pprr
  INNER JOIN pmt_purchase_raw_material_grid pprg
    ON pprr.APP_UID = pprg.APP_UID
	AND LENGTH(LTRIM(RTRIM(pprg.ITEMS))) > 0
    AND pprr.APP_NUMBER =" . $Code;


