<?php
/**
 * PDF Report Layout
 * Rendered directly from $this->pdf_records — no render_body(), no DOMDocument.
 *
 * Setiap section adalah <table> TERPISAH di level atas — tidak ada tabel nested
 * di dalam <td> tabel lain. Ini penting agar:
 *  1. Dompdf dapat memecah tabel data antar halaman secara natural (row by row).
 *  2. Section pendek (header, title, signature, footer) tidak ikut terbawa ke
 *     halaman berikutnya hanya karena tabel data tidak muat.
 */

// ── Resolusi kolom ────────────────────────────────────────────────
$pdf_records = $this->pdf_records;
$first       = !empty($pdf_records) ? current($pdf_records) : null;
$columns     = $first ? array_keys($first) : array();

if (!empty($this->report_hidden_fields)) {
    $hidden  = $this->report_hidden_fields;
    $columns = array_values(array_filter($columns, function($c) use ($hidden) {
        return !in_array($c, $hidden);
    }));
}

// ── Helper: output aman ───────────────────────────────────────────
if (!function_exists('pdf_cell')) {
    function pdf_cell($v) {
        return htmlspecialchars((string)($v ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

// ── Shared inline styles ──────────────────────────────────────────
$S_TH    = 'background-color:#0066cc;color:#ffffff;font-weight:bold;'
         . 'padding:5px 6px;border:1px solid #004499;text-align:left;'
         . 'vertical-align:middle;font-size:9pt;';
$S_TH_NO = $S_TH . 'width:24px;text-align:center;';
$S_TD    = 'padding:4px 6px;border:1px solid #cccccc;vertical-align:top;'
         . 'text-align:left;font-size:9pt;';
$S_TD_NO = $S_TD . 'width:24px;text-align:center;';
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
body { font-family:Arial,Helvetica,sans-serif; font-size:10pt; color:#000; }
</style>
</head>
<body>

<?php /* ══════════════════════════════════════════════════════════
   TABLE 1 — HEADER (logo + nama instansi + tanggal)
   Pendek, pasti muat di halaman pertama.
   ══════════════════════════════════════════════════════════════ */ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
       style="border-collapse:collapse;
              border-top:3px solid #0066cc;
              border-bottom:3px solid #0066cc;
              background-color:#f5f5f5;">
  <tr>
    <td width="58" align="center" valign="middle" style="padding:8px 5px;">
      <img src="<?php print_link('assets/images/logo-sman8.png'); ?>"
           width="50" height="50"/>
    </td>
    <td valign="middle" style="padding:8px 6px;">
      <strong style="font-size:13pt;"><?php echo SITE_NAME; ?></strong><br/>
      <span style="font-size:9pt;color:#555555;">SMA Negeri 8 Banjarmasin</span>
    </td>
    <td align="right" valign="middle"
        style="padding:8px 10px;font-size:9pt;color:#555555;">
      <?php echo date('l, d-m-Y'); ?>
    </td>
  </tr>
</table>

<?php /* ══════════════════════════════════════════════════════════
   TABLE 2 — JUDUL LAPORAN
   ══════════════════════════════════════════════════════════════ */ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
       style="border-collapse:collapse;">
  <tr>
    <td style="font-size:13pt;font-weight:bold;padding:10px 10px 6px 10px;">
      <?php echo htmlspecialchars($this->report_title ?? ''); ?>
    </td>
  </tr>
</table>

<?php /* ══════════════════════════════════════════════════════════
   TABLE 3 — DATA (standalone, TIDAK nested)
   Karena ini tabel level atas, Dompdf bisa memecahnya antar halaman
   secara natural baris per baris tanpa blank page di halaman sebelumnya.
   ══════════════════════════════════════════════════════════════ */ ?>
<?php if (!empty($pdf_records) && !empty($columns)): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
       style="border-collapse:collapse;margin:0 10px;width:calc(100% - 20px);">
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
<p style="padding:10px;font-size:10pt;">Tidak ada data.</p>
<?php endif; ?>

<?php /* ══════════════════════════════════════════════════════════
   TABLE 4 — BLOK TANDA TANGAN
   ══════════════════════════════════════════════════════════════ */ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
       style="border-collapse:collapse;margin-top:20px;">
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%" align="center" valign="top"
        style="font-size:10pt;line-height:1.6;padding:0 10px;">
      Banjarmasin, <?php echo date('d-m-Y'); ?><br/>
      Kepala SMA Negeri 8 Banjarmasin<br/>
      <br/><br/><br/><br/>
      <strong>H. SUTIKNO, S.Pd., M.Pd.</strong><br/>
      NIP. 19710317 199702 1 005
    </td>
  </tr>
</table>

<?php /* ══════════════════════════════════════════════════════════
   TABLE 5 — FOOTER
   Terpisah dari wrapper lain supaya Dompdf tidak mendorongnya
   ke bawah halaman (bug height-fill pada outer table).
   ══════════════════════════════════════════════════════════════ */ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
       style="border-collapse:collapse;margin-top:16px;">
  <tr>
    <td style="border-top:2px solid #0066cc;background-color:#f5f5f5;padding:5px 10px;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0"
             style="border-collapse:collapse;">
        <tr>
          <td width="26" align="center" valign="middle">
            <img src="<?php print_link('assets/images/logo-sman8.png'); ?>"
                 width="18" height="18"/>
          </td>
          <td valign="middle" style="font-size:8pt;padding-left:4px;">
            BerAKSI (berakhlak-cerdas-peduli)
          </td>
          <td align="right" valign="middle" style="font-size:8pt;">
            <?php echo date('l, d-m-Y h:i:s a'); ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

</body>
</html>
