<?php
$Query= "
SELECT 
  IFNULL(prpfbaprt.CompanyId, 36) AS CompanyId,
  prppkg.G_UNIT AS Unit,
  CONCAT(prpfbaprt.APP_NUMBER, '-', prppkg.ROW) AS InqueryNumber,
  prpfbaprt.BRANCH_NAME_LABEL AS StockName,
  prpfbaprt.REQ_NAME_LABEL AS RequstPersonName,
  prppkg.G_OBJECT AS Name,
  REPLACE(prppkg.G_BUY_AMOUNT, ',', '') AS NUMBER,
  NULL AS Brand,
  prppkg.G_TECHNICAL_DETAIL AS DescriptionFani,
  prppkg.G_DATE_REQUIRED AS RequiredDate,
  prpfbaprt.BUSINESS_MANAGER_DESC_LABEL AS Descriptionkarshenas
FROM pmt_request_parts_for_branches_and_projects_report_table prpfbaprt
  JOIN pmt_request_parts_projects_kharidban_grid prppkg
    ON prpfbaprt.APP_NUMBER = prppkg.APP_NUMBER
    AND LENGTH(LTRIM(RTRIM(prppkg.G_OBJECT))) > 0
    AND prpfbaprt.APP_NUMBER =" . $Code;

