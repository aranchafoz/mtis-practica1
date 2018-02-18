
/**
 * Practica1Skeleton.java
 *
 * This file was auto-generated from WSDL
 * by the Apache Axis2 version: 1.6.3  Built on : Jun 27, 2015 (11:17:49 BST)
 */
package org.example.www.practica1;

import java.math.BigInteger;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Date;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 * Practica1Skeleton java skeleton for the axisService
 */
public class Practica1Skeleton {

	private boolean checkSoapKey(String soapKey){
		boolean response = false;
		MysqlConnect mysqlConnect = new MysqlConnect();
		
		String sql = "SELECT count(*) as number FROM `soap_keys` WHERE soapKey = \'" + soapKey + "\';";
		try {
		    PreparedStatement statement = mysqlConnect.connect().prepareStatement(sql);
		    ResultSet rs = statement.executeQuery( sql );
		    int count = 0;
		    while (rs.next()) {
		    	count = rs.getInt("number");
		    }
		    if(count > 0) {
		    	response = true;
		    }
		} catch (SQLException e) {
		    e.printStackTrace();
		} finally {
		    mysqlConnect.disconnect();
		}
		
		
		return response;
	}
	
	/**
	 * @param validarNIF
	 * @return validarNIFResponse
	 */

	public org.example.www.practica1.ValidarNIFResponse validarNIF(org.example.www.practica1.ValidarNIF validarNIF) {
		ValidarNIFResponse respuesta = new ValidarNIFResponse();
		// Check soapKey
		String soapKey = validarNIF.localSoapKey;
		boolean isValidSoapKey = checkSoapKey(soapKey);
		if(!isValidSoapKey) {
			throw new  java.lang.UnsupportedOperationException("Soap Key introduced is invalid");
		} 
			
		String nif = validarNIF.localNif;
		
		// Validando NIF
	    boolean correcto = false;
	    Pattern pattern = Pattern.compile("(\\d{1,8})([TRWAGMYFPDXBNJZSQVHLCKEtrwagmyfpdxbnjzsqvhlcke])");
	    Matcher matcher = pattern.matcher(nif);
	    if (matcher.matches()) {
	        String letra = matcher.group(2);
	        String letras = "TRWAGMYFPDXBNJZSQVHLCKE";
	        int index = Integer.parseInt(matcher.group(1));
	        index = index % 23;
	        String reference = letras.substring(index, index + 1);

	        if (reference.equalsIgnoreCase(letra)) {
	            correcto = true;
	        } else {
	            correcto = false;
	        }
	    } else {
	        correcto = false;
	    }
		
	    respuesta.localIsValid = correcto;
		return respuesta;
	}

	
	/**
	 * 
	 * @param validarIBAN
	 * @return validarIBANResponse1
	 */

	public org.example.www.practica1.ValidarIBANResponse1 validarIBAN(
			org.example.www.practica1.ValidarIBAN validarIBAN) {
		
		ValidarIBANResponse1 respuesta = new ValidarIBANResponse1();
		// Check soapKey
		String soapKey = validarIBAN.localSoapKey;
		boolean isValidSoapKey = checkSoapKey(soapKey);
		if(!isValidSoapKey) {
			throw new  java.lang.UnsupportedOperationException("Soap Key introduced is invalid");
		} 
		
		String cuenta = validarIBAN.localIban;
		
		// Validar IBAN
		boolean esValido = false;
		String error = "";
		int i = 2;
		int caracterASCII = 0; 
		int resto = 0;
		int dc = 0;
		String cadenaDc = "";
		BigInteger cuentaNumero = new BigInteger("0"); 
		BigInteger modo = new BigInteger("97");

		if(cuenta.length() == 24 && cuenta.substring(0,1).toUpperCase().equals("E") 
			&& cuenta.substring(1,2).toUpperCase().equals("S")) {

			do {
				caracterASCII = cuenta.codePointAt(i);
				esValido = (caracterASCII > 47 && caracterASCII < 58);
				i++;
			}
			while(i < cuenta.length() && esValido); 
		
		
			if(esValido) {
				cuentaNumero = new BigInteger(cuenta.substring(4,24) + "142800");
				resto = cuentaNumero.mod(modo).intValue();
				dc = 98 - resto;
				cadenaDc = String.valueOf(dc);
			}	
			
			if(dc < 10) {
				cadenaDc = "0" + cadenaDc;
			} 

			// Comparamos los caracteres 2 y 3 de la cuenta (dígito de control IBAN) con cadenaDc
			if(cuenta.substring(2,4).equals(cadenaDc)) {
				esValido = true;
			} else {
				esValido = false;
				error = "Los dígitos de control IBAN no coinciden con la cadenaDc.";
			}
		} else {
			error = "El IBAN introducido está incompleto";
		}

		respuesta.localIsValid = esValido;
		respuesta.localError = error;
		return respuesta;
	}


	/**
	 * 
	 * @param consultaCodigoPostal
	 * @return consultaCodigoPostalResponse1
	 */

	public org.example.www.practica1.ConsultaCodigoPostalResponse1 consultaCodigoPostal(
			org.example.www.practica1.ConsultaCodigoPostal consultaCodigoPostal) {
		ConsultaCodigoPostalResponse1 respuesta = new ConsultaCodigoPostalResponse1();
		// Check soapKey
		String soapKey = consultaCodigoPostal.localSoapKey;
		boolean isValidSoapKey = checkSoapKey(soapKey);
		if(!isValidSoapKey) {
			throw new  java.lang.UnsupportedOperationException("Soap Key introduced is invalid");
		} 
		
		String codigoPostal = consultaCodigoPostal.localCodigoPostal;
		
		// Obtener datos
		if(codigoPostal.length() != 5){
			respuesta.localCodigoPostal = codigoPostal;
			respuesta.localPoblacion = "";
			respuesta.localProvincia = "";
		} else {
			// Obtener datos de la BD
		    String poblacion = "";
		    String provincia = "";
		    
			MysqlConnect mysqlConnect = new MysqlConnect();
			
			String sql = "SELECT nombre, provincia FROM `poblaciones` WHERE cp = \'" + codigoPostal + "\';";
			try {
			    PreparedStatement statement = mysqlConnect.connect().prepareStatement(sql);
			    ResultSet rs = statement.executeQuery( sql );
			    while (rs.next()) {
			    	poblacion = rs.getString("nombre");
			    	provincia = rs.getString("provincia");
			    }
			} catch (SQLException e) {
			    e.printStackTrace();
			} finally {
			    mysqlConnect.disconnect();
			}
			
			respuesta.localCodigoPostal = codigoPostal;
			respuesta.localPoblacion = poblacion;
			respuesta.localProvincia = provincia;
		}
		
		return respuesta;
	}
	
	
	private int getLastPresupuestoId() {
		int lastId = 0;
	    
		MysqlConnect mysqlConnect = new MysqlConnect();
		
		String sql = "SELECT id FROM `presupuestos`;";
		try {
		    PreparedStatement statement = mysqlConnect.connect().prepareStatement(sql);
		    ResultSet rs = statement.executeQuery( sql );
		    while (rs.next()) {
		    	int id = rs.getInt("id");
		    	
		    	if(id > lastId) {
		    		lastId = id;
		    	}
		    }
		} catch (SQLException e) {
		    e.printStackTrace();
		} finally {
		    mysqlConnect.disconnect();
		}
		
		return lastId;
	}
	
	/**
	 * 
	 * @param generarPresupuesto
	 * @return generarPresupuestoResponse1
	 */

	public org.example.www.practica1.GenerarPresupuestoResponse1 generarPresupuesto(
			org.example.www.practica1.GenerarPresupuesto generarPresupuesto) {
		GenerarPresupuestoResponse1 respuesta = new GenerarPresupuestoResponse1();
		// Check soapKey
		String soapKey = generarPresupuesto.localSoapKey;
		boolean isValidSoapKey = checkSoapKey(soapKey);
		if(!isValidSoapKey) {
			throw new  java.lang.UnsupportedOperationException("Soap Key introduced is invalid");
		} 
		
		Date fechaPresupuesto = generarPresupuesto.localFechaPresupuesto;
		java.text.SimpleDateFormat sdf = 
			     new java.text.SimpleDateFormat("yyyy-MM-dd");

		String fechaPresupuestoString = sdf.format(fechaPresupuesto);
		int idCliente = generarPresupuesto.localIdCliente;
		String referenciaProducto = generarPresupuesto.localReferenciaProducto;
		int cantidadProducto = generarPresupuesto.localCantidadProducto;
		

		// Obtener id para insertar en la BD
	    int lastId = getLastPresupuestoId();
	    int presupuestoId = lastId + 1;
	    
	    // Insertar presupuesto en la BD
	    MysqlConnect mysqlConnect = new MysqlConnect();
		
		String sql = "INSERT INTO `presupuestos`(`id`, `idCliente`, `fechaPresupuesto`, `referenciaProducto`, `cantidadProducto`)" 
				+ " VALUES (" + presupuestoId + "," 
					+ idCliente + "," 
					+ "STR_TO_DATE('" + fechaPresupuestoString + "', '%Y-%m-%d') ,'"
					+ referenciaProducto + "',"
					+ cantidadProducto + ");";
		try {
		    PreparedStatement statement = mysqlConnect.connect().prepareStatement(sql);
		    //statement.execute( sql );
		    int insertedRows =statement.executeUpdate();
		    if(insertedRows > 0) {
				respuesta.localIdPresupuesto = presupuestoId;
				respuesta.localPresupuestoGeneradoCorrectamente = true;
		    } else {
				respuesta.localIdPresupuesto = -1;
				respuesta.localPresupuestoGeneradoCorrectamente = false;
		    }
		} catch (SQLException e) {
			respuesta.localIdPresupuesto = -1;
			respuesta.localPresupuestoGeneradoCorrectamente = false;
		    e.printStackTrace();
		} finally {
		    mysqlConnect.disconnect();
		}
		
		// TODO: check insert was successfull
		
		
		return respuesta;
	}

}
