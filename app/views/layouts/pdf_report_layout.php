<?php
/**
 * PDF Report Layout
 * Rendered directly from $this->pdf_records — no render_body(), no DOMDocument.
 *
 * Layout uses a single outer <table> so every section is a <tr><td>.
 * This avoids Dompdf's div-wrapping-table height-calculation bug (older Dompdf
 * calculates div height as 0 when the only child is a table, causing all
 * sections to stack at y=0 and overlap).
 *
 * All data-cell styling is inline — no CSS classes used for the data table
 * so there is no risk of class conflicts with other rules.
 */

// ── Column resolution ─────────────────────────────────────────────
$pdf_records = $this->pdf_records;
$first       = !empty($pdf_records) ? current($pdf_records) : null;
$columns     = $first ? array_keys($first) : array();

if (!empty($this->report_hidden_fields)) {
    $hidden = $this->report_hidden_fields;
    $columns = array_values(array_filter($columns, function($c) use ($hidden) {
        return !in_array($c, $hidden);
    }));
}

// ── Safe-string helper ────────────────────────────────────────────
if (!function_exists('pdf_cell')) {
    function pdf_cell($v) {
        return htmlspecialchars((string)($v ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

// ── Shared inline styles ──────────────────────────────────────────
$S_TH = 'background-color:#0066cc;color:#ffffff;font-weight:bold;'
      . 'padding:5px 6px;border:1px solid #004499;text-align:left;'
      . 'vertical-align:middle;font-size:9pt;';
$S_TD = 'padding:4px 6px;border:1px solid #cccccc;vertical-align:top;'
      . 'text-align:left;font-size:9pt;';
$S_TD_NO = $S_TD . 'width:24px;text-align:center;';
$S_TH_NO = $S_TH . 'width:24px;text-align:center;';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title><?php echo htmlspecialchars($this->report_title ?? ''); ?></title>
<style>
@page {
    margin-top:    15mm;
    margin-right:  10mm;
    margin-bottom: 15mm;
    margin-left:   10mm;
}
* { margin:0; padding:0; }
body {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10pt;
    color: #000000;
}
</style>
</head>
<body>

<?php /*
  ┌──────────────────────────────────────────────────────────────────┐
  │  OUTER WRAPPER TABLE — one column, each section = one <tr><td>  │
  │  Row heights are driven by content, not CSS — Dompdf-safe.      │
  └──────────────────────────────────────────────────────────────────┘
*/ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
       style="border-collapse:collapse; table-layout:fixed;">

  <?php /* ══ HEADER ROW ══════════════════════════════════════════ */ ?>
  <tr>
    <td style="border-top:3px solid #0066cc; border-bottom:3px solid #0066cc;
               background-color:#f5f5f5; padding:8px 10px;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0"
             style="border-collapse:collapse;">
        <tr>
          <td width="58" align="center" valign="middle">
            <img src="<?php print_link('assets/images/logo-sman8.png'); ?>"
                 width="50" height="50"/>
          </td>
          <td valign="middle" style="padding-left:8px;">
            <strong style="font-size:13pt;"><?php echo SITE_NAME; ?></strong><br/>
            <span style="font-size:9pt; color:#555555;">SMA Negeri 8 Banjarmasin</span>
          </td>
          <td align="right" valign="middle"
              style="font-size:9pt; color:#555555;">
            <?php echo date('l, d-m-Y'); ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <?php /* ══ TITLE ROW ═══════════════════════════════════════════ */ ?>
  <tr>
    <td style="font-size:13pt; font-weight:bold;
               padding:10px 10px 6px 10px;">
      <?php echo htmlspecialchars($this->report_title ?? ''); ?>
    </td>
  </tr>

  <?php /* ══ DATA TABLE ROW ═════════════════════════════════════ */ ?>
  <tr>
    <td style="padding:0 10px;">
      <?php if (!empty($pdf_records) && !empty($columns)): ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0"
             style="border-collapse:collapse; margin-bottom:6px;">
        <thead>
          <tr>
            <th style="<?php echo $S_TH_NO; ?>">#</th>
            <?php foreach ($columns as $col): ?>
            <th style="<?php echo $S_TH; ?>">
              <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $col))); ?>
            </th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php $rowNo = 1; foreach ($pdf_records as $row): ?>
          <tr>
            <td style="<?php echo $S_TD_NO; ?>"><?php echo $rowNo++; ?></td>
            <?php foreach ($columns as $col): ?>
            <td style="<?php echo $S_TD; ?>"><?php echo pdf_cell($row[$col] ?? null); ?></td>
            <?php endforeach; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php else: ?>
      <p style="padding:10px; font-size:10pt;">Tidak ada data.</p>
      <?php endif; ?>
    </td>
  </tr>

  <?php /* ══ SPACER ROW ══════════════════════════════════════════ */ ?>
  <tr>
    <td style="height:20px;">&nbsp;</td>
  </tr>

  <?php /* ══ SIGNATURE ROW ═══════════════════════════════════════ */ ?>
  <tr>
    <td style="padding:0 10px;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0"
             style="border-collapse:collapse;">
        <tr>
          <td width="50%">&nbsp;</td>
          <td width="50%" align="center" valign="top"
              style="font-size:10pt; line-height:1.6;">
            Banjarmasin, <?php echo date('d-m-Y'); ?><br/>
            Kepala SMA Negeri 8 Banjarmasin<br/>
            <br/><br/><br/><br/>
            <strong>H. SUTIKNO, S.Pd., M.Pd.</strong><br/>
            NIP. 19710317 199702 1 005
          </td>
        </tr>
      </table>
    </td>
  </tr>

</table><!-- /outer wrapper: ends before footer so Dompdf cannot push it to page-bottom -->

<?php /* ══ FOOTER — separate table, flows right after content ══ */ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
       style="border-collapse:collapse; margin-top:16px;">
  <tr>
    <td style="border-top:2px solid #0066cc; background-color:#f5f5f5;
               padding:5px 10px;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0"
             style="border-collapse:collapse;">
        <tr>
          <td width="26" valign="middle" align="center">
            <img src="<?php print_link('assets/images/logo-sman8.png'); ?>"
                 width="18" height="18"/>
          </td>
          <td valign="middle" style="font-size:8pt; padding-left:4px;">
            BerAKSI (berakhlak-cerdas-peduli)
          </td>
          <td align="right" valign="middle" style="font-size:8pt;">
            <?php echo date('l, d-m-Y h:i:s a'); ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table><!-- /footer -->

</body>
</html>
