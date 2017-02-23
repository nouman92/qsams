import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Calendar;
import java.util.Iterator;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

public class main {

	public static void main(String[] arg) {
		//populateGrid();
		//populateAssets();
		populateAssetsData();
	}

	public static void populateGrid() {
		try {
			Class.forName("com.mysql.jdbc.Driver").newInstance();
		} catch (InstantiationException | IllegalAccessException | ClassNotFoundException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		Connection conn  = null;
		try {
			conn = DriverManager.getConnection("jdbc:mysql://localhost:3307/qaams", "root", "nouman92");
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		String grid_query = " insert into assets_grids (block_number, row_number, table_number, panel_number , panel_position  ) values (?, ?, ?, ?, ?)";
		int blocks = 100;
		int rows = 13;
		int table = 8;
		int panel = 40;
		for (int i = 95; i <= blocks; i++) {
			for (int j = 1; j <= rows; j++) {
				for (int k = 1; k <= table; k++) {
					for (int l = 1; l <= panel; l++) {
						String position = "Top";
						if (l % 2 == 0)
							position = "Bottom";
						try {
							PreparedStatement assets_grid_add = conn.prepareStatement(grid_query);
							assets_grid_add.setInt(1, i);
							assets_grid_add.setInt(2, j);
							assets_grid_add.setInt(3, k);
							assets_grid_add.setInt(4, l);
							assets_grid_add.setString(5, position);
							assets_grid_add.execute();
							assets_grid_add.close();
						} catch (Exception ex) {
							System.out.println("Exception" + ex.getMessage());
						}
					}
				}
			}
		}
		try {
			conn.close();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

	public static void populateAssets(){

			try {
				Class.forName("com.mysql.jdbc.Driver").newInstance();
			} catch (InstantiationException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (IllegalAccessException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (ClassNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			Connection conn = null;
			try {
				conn = DriverManager.getConnection("jdbc:mysql://localhost:3307/qaams", "root", "nouman92");
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}

			String grid_select_query = " SELECT * FROM assets_grids where block_number = ? and row_number = ? and table_number = ? and panel_number = ?; ";
			String assets_query = " insert into assets (active, installed, seriel_no, assets_grid_id) values (?, ?, ?, ?)";
			Calendar calendar = Calendar.getInstance();
			java.sql.Date startDate = new java.sql.Date(calendar.getTime().getTime());

			File folder = new File("/home/nouman/Desktop/locationData");
			File[] listOfFiles = folder.listFiles();

			for (int i = 0; i < listOfFiles.length; i++) {
				if (listOfFiles[i].isFile()) {
					System.out.print("Reading File " + listOfFiles[i].getName()+"...");
					FileInputStream file = null;
					try {
						file = new FileInputStream(listOfFiles[i]);
					} catch (FileNotFoundException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					XSSFWorkbook workbook = null;
					try {
						workbook = new XSSFWorkbook(file);
					} catch (IOException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					XSSFSheet sheet = workbook.getSheetAt(0);
					Iterator<Row> rowIterator = sheet.iterator();
					Row block_row = rowIterator.next();
					Cell block_num = block_row.getCell(2);
					double block = 0;
					try {
						block = block_num.getNumericCellValue();
					} catch (Exception ex) {
						String numberOnly = block_num.getStringCellValue().replaceAll("[^0-9]", "");
						block = Double.parseDouble(numberOnly);
					}
					rowIterator.next();
					int index = 0;
					double prev = 0;
					while (rowIterator.hasNext()) {
						try {
							Row row = rowIterator.next();
							double row_num = row.getCell(1).getNumericCellValue();
							double table_num = row.getCell(2).getNumericCellValue();
							if (index != 0 && prev != table_num) {
								index = 1;
							} else {
								index++;
							}
							prev = table_num;
							String seriel = row.getCell(4).getStringCellValue();
							// String position =
							// row.getCell(3).getStringCellValue();
							// System.out.println(index++ + ":" + block + "
							// "+row_num + " " + table_num + " " + position + "
							// " +
							// seriel + "\n");
							PreparedStatement grid_select = conn.prepareStatement(grid_select_query);
							grid_select.setDouble(1, block);
							grid_select.setDouble(2, row_num);
							grid_select.setDouble(3, table_num);
							grid_select.setDouble(4, index);
							ResultSet rs = grid_select.executeQuery();
							if (rs.next()) {
								int id = rs.getInt("id");
								PreparedStatement assets_add = conn.prepareStatement(assets_query);
								assets_add.setBoolean(1, true);
								assets_add.setDate(2, startDate);
								assets_add.setString(3, seriel);
								assets_add.setInt(4, id);
								assets_add.execute();
							}

						} catch (Exception ex) {
							ex.printStackTrace();
						}
					}
					try {
						workbook.close();
						file.close();
						listOfFiles[i].delete();
					} catch (Exception ex) {
						ex.printStackTrace();
					}
					System.out.print("Done \n");

				} else if (listOfFiles[i].isDirectory()) {
					System.out.println("Directory " + listOfFiles[i].getName());
				}
			}
			try {
				conn.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}

	}

	public static void populateAssetsData(){
		try {
			Class.forName("com.mysql.jdbc.Driver").newInstance();
		} catch (InstantiationException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		} catch (IllegalAccessException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		} catch (ClassNotFoundException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		Connection conn = null;
		try {
			conn = DriverManager.getConnection("jdbc:mysql://localhost:3307/qaams", "root", "nouman92");
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}

		String asset_select_query = " select * from assets where seriel_no = ? ";
		File folder = new File("./");
		File[] listOfFiles = folder.listFiles();

		for (int i = 0; i < listOfFiles.length; i++) {
			if (listOfFiles[i].isFile()) {
				System.out.print("Reading File " + listOfFiles[i].getName()+"...");
				FileInputStream file = null;
				try {
					file = new FileInputStream(listOfFiles[i]);
				} catch (FileNotFoundException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				XSSFWorkbook workbook = null;
				try {
					workbook = new XSSFWorkbook(file);
				} catch (IOException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				XSSFSheet sheet = workbook.getSheetAt(0);
				Iterator<Row> rowIterator = sheet.iterator();
				rowIterator.next();
				int index = 0;
				while (rowIterator.hasNext()) {
					try {
						Row row = rowIterator.next();
						String seriel = row.getCell(0).getStringCellValue();
						double v_oc =  row.getCell(1).getNumericCellValue();
						double i_sc = row.getCell(2).getNumericCellValue();
						double v_mppt = row.getCell(3).getNumericCellValue();
						double i_mppt = row.getCell(4).getNumericCellValue();
						double max_power = row.getCell(5).getNumericCellValue();
						double fil_Factor = row.getCell(6).getNumericCellValue();

						 System.out.println(
						  index++ + ":" +
						  seriel + " "+
						  v_oc + " " +
						  i_sc + " " +
						  v_mppt + " " +
						  i_mppt + " " +
						  max_power + " " +
						  fil_Factor + "\n");

						PreparedStatement asset_select = conn.prepareStatement(asset_select_query,ResultSet.TYPE_SCROLL_SENSITIVE,ResultSet.CONCUR_UPDATABLE);
						asset_select.setString(1, seriel);
						ResultSet rs = asset_select.executeQuery();
						if (rs.next()) {
							rs.updateDouble(7, v_oc);
							rs.updateDouble(8, i_sc);
							rs.updateDouble(9, v_mppt);
							rs.updateDouble(10, i_mppt);
							rs.updateDouble(11, max_power);
							rs.updateDouble(12, fil_Factor);
						//	rs.updateRow();
						}

					} catch (Exception ex) {
						ex.printStackTrace();
					}
				}
				try {
					workbook.close();
					file.close();
					listOfFiles[i].delete();
				} catch (Exception ex) {
					ex.printStackTrace();
				}
			}
		}
		System.out.print("Done \n");

		try {
			conn.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}

	}
}
