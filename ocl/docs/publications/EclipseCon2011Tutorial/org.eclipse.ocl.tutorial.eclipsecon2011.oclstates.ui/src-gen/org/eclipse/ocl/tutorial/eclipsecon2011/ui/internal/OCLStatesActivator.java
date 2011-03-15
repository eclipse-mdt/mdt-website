/*
 * generated by Xtext
 */
package org.eclipse.ocl.tutorial.eclipsecon2011.ui.internal;

import static com.google.inject.util.Modules.override;
import static com.google.inject.Guice.createInjector;

import org.apache.log4j.Logger;

import org.eclipse.ui.plugin.AbstractUIPlugin;
import org.osgi.framework.BundleContext;

import com.google.inject.Injector;
import com.google.inject.Module;

import java.util.Map;
import java.util.HashMap;

/**
 * This class was generated. Customizations should only happen in a newly
 * introduced subclass. 
 */
public class OCLStatesActivator extends AbstractUIPlugin {

	private Map<String,Injector> injectors = new HashMap<String,Injector>();
	private static OCLStatesActivator INSTANCE;

	public Injector getInjector(String languageName) {
		return injectors.get(languageName);
	}
	
	@Override
	public void start(BundleContext context) throws Exception {
		super.start(context);
		INSTANCE = this;
		try {
			registerInjectorFor("org.eclipse.ocl.tutorial.eclipsecon2011.OCLStates");
			
		} catch (Exception e) {
			Logger.getLogger(getClass()).error(e.getMessage(), e);
			throw e;
		}
	}
	
	protected void registerInjectorFor(String language) throws Exception {
		injectors.put(language, createInjector(
		  override(override(getRuntimeModule(language)).with(getSharedStateModule())).with(getUiModule(language))));
	}
	
	@Override
	public void stop(BundleContext context) throws Exception {
		injectors.clear();
		INSTANCE = null;
		super.stop(context);
	}
	
	public static OCLStatesActivator getInstance() {
		return INSTANCE;
	}
	
	protected Module getRuntimeModule(String grammar) {
		if ("org.eclipse.ocl.tutorial.eclipsecon2011.OCLStates".equals(grammar)) {
		  return new org.eclipse.ocl.tutorial.eclipsecon2011.OCLStatesRuntimeModule();
		}
		
		throw new IllegalArgumentException(grammar);
	}
	
	protected Module getUiModule(String grammar) {
		if ("org.eclipse.ocl.tutorial.eclipsecon2011.OCLStates".equals(grammar)) {
		  return new org.eclipse.ocl.tutorial.eclipsecon2011.ui.OCLStatesUiModule(this);
		}
		
		throw new IllegalArgumentException(grammar);
	}
	
	protected Module getSharedStateModule() {
		return new org.eclipse.xtext.ui.shared.SharedStateModule();
	}
	
}
